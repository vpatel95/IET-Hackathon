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
              <a class="navbar-brand " href="index.php" style="font-family: 'Lobster Two', cursive;font-size: 25px"; >BucketList</a>
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

        <div class="container container-fluid" style="margin-top: 5%;margin-left:12%;text-align: center;">
            <div class="row">
                <div class="card" style="">
                <h2 class="card-title" style="font-family: 'Capriola', sans-serif;margin-bottom: 2%;">User Buckets</h2>
                <hr class="customhr">
                <p class="card-text">
                    <?php 
                        $sql="SELECT * FROM category_table order by username desc";
                        $result=mysqli_query($db,$sql);
                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    ?>
                        <div class="col-md-5" style="font-size: 15px;font-family: 'Capriola', sans-serif;box-shadow: 10px 10px 5px #888888;">
                            <img class="card-img-top" src="http://ro2.biz/images/user.png" alt="Card image cap" height="150px" width="150px" style="margin-top: 7%;">
                            <?php
                                $id=$row['id'];
                                $username=$row['username'];
                                $category=$row['category'];

                                $url = "fulllist.php?id=$id&category=$category";
                                echo "<br><br>Username :".$username."<br>";
                                echo "Category :".$category."<br>"; 
                            ?>
                            <br><br><a href="<?php echo $url ?>" class="btn btn-primary">View Bucket</a><br><br>
                            <hr>
                        </div>
                    <?php } ?> 
                </p>
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