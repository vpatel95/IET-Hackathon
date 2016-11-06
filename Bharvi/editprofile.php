<?php
  
  define('DB_SERVER', '127.0.0.1');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_DATABASE', 'bucketlist');
  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die(mysqli_error());
  $error="";
  $uname="";
  session_start();
  $username=$_SESSION['user_session'];
  $sql="SELECT * from users where username='$username';";
  $result=mysqli_query($db,$sql);
  $row=mysqli_fetch_assoc($result);
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
<body style="">
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
              <a class="navbar-brand " href="#" style="font-family: 'Capriola', sans-serif;font-size: 25px"; >BucketList</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="border:none;">
              
              <!--SOCIAL ICONS-->
              <ul class="nav navbar-nav navbar-right" style="border:none; ">
                <li><a href="index.php">Home</a></li>
                <li><a href="share.php">Buckets</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class=" glyphicon glyphicon-user"></span><?php echo $username; ?><span class="caret"></span></a>
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

        <div class="container-fluid" style="margin-top: 5%;margin-left: 20%;">
          <div class="col-md-12">
            <div><h3>Edit Profile</h3></div>
    
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
              <label>Username:</label><input type="text" name="username" value="<?php echo $row['username']; ?>"> <br>
              
              <label>First Name:</label> <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>"><br>
              <label>Last Name:</label> <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>"><br>
              <label>Email:</label> <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
              <input type="submit" name="update" value="update">
            </form>
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

<?php

  if(isset($_POST['username'])){
    $username="";
    /*$password="";*/
    $firstname="";
    $lastname="";
    $email="";
    $uname= $_SESSION['user_session'];

    @$username=$_POST['username'];
    /*@$password=md5($_POST['password']);*/
    @$firstname=$_POST['firstname'];
    @$lastname=$_POST['lastname'];
    @$email=$_POST['email'];



    $username=mysqli_escape_string($db,$username);
    /*$password=mysqli_escape_string($db,$password);*/
    $firstname=mysqli_escape_string($db,$firstname);
    $lastname=mysqli_escape_string($db,$lastname);
    $email=mysqli_escape_string($db,$email);

  if(empty($username) || empty($firstname) || empty($lastname) || empty($email)){
    echo "<script>alert('Please fill all the fields');</script>";
  }

  $query=
  @mysqli_query($db,"UPDATE users SET username='$username', password='$password',firstname='$firstname', lastname='$lastname', email='$email' WHERE username='$uname'");
  


  if($query){
    echo "<script> alert('Profile updated successfully !');</script>";
    header("location:userindex.php");
    
  }
  else{
    echo "<script> alert('Profile not updated !');</script>";
    $username="";
    $password="";
    $firstname="";
    $lastname="";
    $email="";


  }
}


?>