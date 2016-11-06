<?php
  
  define('DB_SERVER', '127.0.0.1');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_DATABASE', 'bucketlist');
  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die(mysqli_error());
  $error="";
  $uname="";
  session_start();
  $uname=$_SESSION['user_session'];
  $sql="SELECT id FROM category_table WHERE username='$uname' and category='reading';";
  $result=mysqli_query($db,$sql);
  $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);
  if($count == 1)
    {
      header("location:updateread.php");
    }
    else
    {

  @$field1="";
  @$field2="";
  @$field3="";
  @$field4="";
  @$field5="";
  @$field6="";
  @$field7="";
  @$field8="";
  @$field9="";
  @$field10="";
  
  $field1=$_POST['field1'];
  @$field2=$_POST['field2'];
  @$field3=$_POST['field3'];
  @$field4=$_POST['field4'];
  @$field5=$_POST['field5'];
  @$field6=$_POST['field6'];
  @$field7=$_POST['field7'];
  @$field8=$_POST['field8'];
  @$field9=$_POST['field9'];
  @$field10=$_POST['field10'];

  $field1=mysqli_escape_string($db,$field1);
  $field2=mysqli_escape_string($db,$field2);
  $field3=mysqli_escape_string($db,$field3);
  $field4=mysqli_escape_string($db,$field4);
  $field5=mysqli_escape_string($db,$field5);
  $field6=mysqli_escape_string($db,$field6);
  $field7=mysqli_escape_string($db,$field7);
  $field8=mysqli_escape_string($db,$field8);
  $field9=mysqli_escape_string($db,$field9);
  $field10=mysqli_escape_string($db,$field10);

  if(isset($_POST['field1']))
  {

  

    $query = mysqli_query($db, "INSERT INTO category_table (username,category, field1, field2,field3,field4,field5,field6,field7,field8,field9,field10) VALUES ('$uname','reading', '$field1', '$field2','$field3','$field4','$field5','$field6','$field7','$field8','$field9','$field10')");
 

  if($query)
      {
        $msg = "Posted!";
        echo "<script> alert('Posted');</script>";
        header('location:userindex.php');
        
      }

      else{ 
        echo "<script> alert('Something Went Wrong !');</script>";
      }

}
}
  

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="assets/css/custom.css" rel="stylesheet">
    <link rel="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lobster|Roboto" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
</	
<body>
	<nav class="navbar navbar-default navbar-fixed-top  " id="navbar1"  style="/*background:transparent*/;border:none;color:#fff;opacity: 3%;background-color: #fff;
  border-color: rgba(34, 34, 34, 0.05);
  
  -webkit-transition: all 0.35s;
  -moz-transition: all 0.35s;
  margin-bottom: 0px;
  transition: all 0.60s;">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" >
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" style="border:none;float: left;">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand " href="index.php" style="font-family: 'Lobster Two', cursive;font-size: 25px"; >BucketList</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="border:none;">
              
              <!--SOCIAL ICONS-->
              <ul class="nav navbar-nav navbar-right" style="border:none; ">
              	<li><a href="index.php">Home</a></li>
                <li><a href="share.php">Buckets</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class=" glyphicon glyphicon-user"></span><?php echo $_SESSION["user_session"]; ?><span class="caret"></span></a>
                <ul class="dropdown-menu" style="font-family: 'Capriola', sans-serif;color: #006699;">
                  <li><a href="viewprofile.php">Profile</a></li>
                  <li><a href="editprofile.php">Edit Profile</a></li>
                  <li><a href="logout.php">Logout</a></li>

                  
                  
                </ul>
                </ul>

              <!--SOCIAL ICONS-->

            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

        <div class="container-fluid" style="margin-top: 2%;    margin-left: 10%;">
          <h2 style="text-align: center;font-family: 'Capriola', sans-serif;margin-left: 5%">Fill Your Reading Bucket</h2>
          <hr class="customhr">
            <form class="form-horizontal reveal " style="margin-top: 5%;" method="post" id="cform">

              <div class="form-group">
              
                <div class="col-sm-10"> 
                <input type="text" class="form-control" id="field1" placeholder="" name="field1">
                </div>
                </div>
                <div class="form-group">
                
                <div class="col-sm-10"> 
                  <input type="text" class="form-control" id="field2" placeholder="" name="field2">
                </div>
              </div>
              <div class="form-group">
                
                <div class="col-sm-10"> 
                  <input type="text"  class="form-control" id="field3" placeholder="" name="field3">
                </div>
              </div>
              <div class="form-group">
                
                <div class="col-sm-10">
                  <input type="text" id ="field4" class="form-control" id="email" placeholder="" name="field4">
                </div>
              </div>
              <div class="form-group">
                
                <div class="col-sm-10"> 
                  <input type="text" class="form-control" id="field5" placeholder="" name="field5">
                </div>
              </div>
              <div class="form-group">
                
                <div class="col-sm-10"> 
                  <input type="text" class="form-control" id="field6" placeholder="" name="field6">
                </div>
              </div>

              <div class="form-group">
                
                <div class="col-sm-10"> 
                  <input type="text" class="form-control" id="field7" placeholder="" name="field7">
                </div>
              </div>

              <div class="form-group">
                
                <div class="col-sm-10"> 
                  <input type="text" class="form-control" id="field8" placeholder="" name="field8">
                </div>
              </div>

               <div class="form-group">
                
                <div class="col-sm-10"> 
                  <input type="text" class="form-control" id="field9" placeholder="" name="field9">
                </div>
              </div>

               <div class="form-group">
                
                <div class="col-sm-10"> 
                  <input type="text" class="form-control" id="field10" placeholder="" name="field10">
                </div>
              </div>
              
              <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default" id="submit" name="submit " style="color: #000;border: 1.5px solid #000;margin-left: -21%;" >Add</button>
                </div>
              </div>
            </form>
              </div>
            </div>
        </div>
        
     


<script src="https://cdn.jsdelivr.net/scrollreveal.js/3.3.1/scrollreveal.min.js"></script>
	<script type="text/javascript">

      window.sr = ScrollReveal();
      
      sr.reveal('.reveal', { duration: 1000 });

      </script>

    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
