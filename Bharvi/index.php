<?php
  
  define('DB_SERVER', '127.0.0.1');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_DATABASE', 'bucketlist');
  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die(mysqli_error());
  $error="";
  session_start();
  if((isset($_SESSION['user_session']))){
    //mysqli_close($connection); // Closing Connection
    header('Location: userindex.php'); // Redirecting To Home Page
    }
    $uname=$_SESSION['user_session'];

  if(isset($_POST['user'])){
    if(empty($_POST['user']) || empty($_POST['pass1'])){
      /*$error="Please Fill All The Fields.";*/
      echo "<script>alert('Fill all fields');</script>";
    }
    else{
      $username=$_POST['user'];
      $password=$_POST['pass1'];


      // To protect from MySQL injection
      $username = stripslashes($username);
      $password = stripslashes($password);
      $username = mysqli_real_escape_string($db, $username);
      $password = mysqli_real_escape_string($db, $password);
      $password = md5($password);

      $sql="SELECT username FROM users WHERE username ='$username' and password='$password'";
      $result=mysqli_query($db,$sql);
      $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

      if(mysqli_num_rows($result) == 1)
        /*if(row['password']==$password*/{

        session_start();
        $_SESSION['user_session'] = $username; // Initializing Session
        
        header("location: userindex.php"); // Redirecting To Other Page
        
      }else{
        $error="incorrect username or passoword ";
        
        echo '<script type="text/javascript">alert("' . $error . '")</script>';
        /*echo "<script>alert('incorrect username or passoword');</script>";*/


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
    <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
    
	<link href="https://fonts.googleapis.com/css?family=Acme|Lobster+Two" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lobster|Roboto" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
</	

<body>
<div class="js">
    <div id="preloader"></div>
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
              <a class="navbar-brand " href="index.php" style="font-family: 'Lobster Two', cursive;font-size: 25px;font-weight: 20px;"; >BucketList</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="border:none;">
              
              <!--SOCIAL ICONS-->
              <ul class="nav navbar-nav navbar-right" style="border:none; ">
              	<li><a href="index.php" >Home</a></li>
                <li><a href="share.php">Buckets</a></li>
                <li><a href="#loginmodal"  data-toggle="modal">Sign In</a></li>
                <li><a href="#" id="signup">Sign Up</a></li>
                
                </ul>

              <!--SOCIAL ICONS-->

            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

        <div class="container cont " style="overflow-x: hidden;" >
          <h2 class="h2  animated fadeIn" id="myh2" style="font-family: 'Lobster Two', cursive;">BucketList</h2>  
          <hr class="customhr">
          <h3 class="h3 animated fadeIn" id="startchange"></h3>
          <div class="arrow animated bounce">
  <img width="40" height="40" alt="" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTIgNTEyIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik0yOTMuNzUxLDQ1NS44NjhjLTIwLjE4MSwyMC4xNzktNTMuMTY1LDE5LjkxMy03My42NzMtMC41OTVsMCwwYy0yMC41MDgtMjAuNTA4LTIwLjc3My01My40OTMtMC41OTQtNzMuNjcyDQoJbDE4OS45OTktMTkwYzIwLjE3OC0yMC4xNzgsNTMuMTY0LTE5LjkxMyw3My42NzIsMC41OTVsMCwwYzIwLjUwOCwyMC41MDksMjAuNzcyLDUzLjQ5MiwwLjU5NSw3My42NzFMMjkzLjc1MSw0NTUuODY4eiIvPg0KPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTIyMC4yNDksNDU1Ljg2OGMyMC4xOCwyMC4xNzksNTMuMTY0LDE5LjkxMyw3My42NzItMC41OTVsMCwwYzIwLjUwOS0yMC41MDgsMjAuNzc0LTUzLjQ5MywwLjU5Ni03My42NzINCglsLTE5MC0xOTBjLTIwLjE3OC0yMC4xNzgtNTMuMTY0LTE5LjkxMy03My42NzEsMC41OTVsMCwwYy0yMC41MDgsMjAuNTA5LTIwLjc3Miw1My40OTItMC41OTUsNzMuNjcxTDIyMC4yNDksNDU1Ljg2OHoiLz4NCjwvc3ZnPg0K" />
</div>
          </div>

        <!-- <div class="about">
         	<div class="container">
         		<h2 style=""><strong>About WebNation</strong></h2>
         		<hr class="customhr">
         		<div class="col-md-4">
         			<img src="assets/img/webdevelopment.png" class="img-rounded img-responsive reveal" alt="image" width="250" height="250" style="margin-top: 10%;margin-left: 5%;">
         		</div>
         		<div class="col-md-8">
         			<p class="reveal">
         				WebNation is an education portal for teaching web development from basic to intermediate level.Learn front-end development
         				and back-end development by building real projects. Build beautiful websites, arcade games, your personal website and much more. Learn the fundamentals of how the web works and gain working knowledge with HTML, CSS and Javascript.Best of all we guide you through the process with 1 on 1 coaching if you ever get stuck.
         			</p>
         		</div>
         	</div>
         	
         </div> !-->

         <div class="register">
         	
         		<div class="container registercontainer">
         		<h2>Register</h2>
         		<hr class="customhr">
         		
         		<div class="col-md-12" style="margin-left: 5%;margin-top: -7%;">
         			<div class="regdiv" style="color: #000;">
         				<form class="form-horizontal reveal " style="margin-top: 10%;" method="post" id="cform">
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Username :</label>
                            <div class="col-sm-10"> 
                              <input type="text" class="form-control" id="username" placeholder="" name="username">
                            </div>
                          </div>
         				<div class="form-group">
						    <label class="control-label col-sm-2" >First Name:</label>
						    <div class="col-sm-10"> 
						      <input type="text" class="form-control" id="fname" placeholder="" name="fname">
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="control-label col-sm-2" >Last Name:</label>
						    <div class="col-sm-10"> 
						      <input type="text"  class="form-control" id="lname" placeholder="" name="lname">
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="email">Email:</label>
						    <div class="col-sm-10">
						      <input type="email" id ="email" class="form-control" id="email" placeholder="" name="email">
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="pwd">Password:</label>
						    <div class="col-sm-10"> 
						      <input type="password" class="form-control" id="pass1" placeholder="" name="pass1">
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
						    <div class="col-sm-10"> 
						      <input type="password" class="form-control" id="pass2" placeholder="" name="pass2">
						    </div>
						  </div>
						  
						  <div class="form-group"> 
						    <div class="col-sm-offset-2 col-sm-10">
						      <button type="submit" class="btn btn-default" id="submit" name="submit" style="border: 1.5px solid #000; color: #000;">Register</button>
						    </div>
						  </div>
						</form>
         			</div>
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

    <div id="loginmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="font-family: 'Capriola', sans-serif; ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body" style="font-family: 'Capriola', sans-serif;">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form-group " style="width: 100%;">
            <label>Username:</label>
            <input name="user" class="form-control" style="width: 100%">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control"  name="pass1" style="width: 100%">
          </div>
          
          <button type="submit" class="btn btn-primary" name="" style="border-radius: 0px;">Login</button>
        </form>

      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <!-- <button type="submit" class="btn btn-primary" name="submit" style="border-radius: 0px;">Login</button> -->
      </div>
    </div>

  </div>
</div>
</div>
    <script type="text/javascript">
    $(document).ready(function(){
      $(window).load(function(){
    $('#preloader').fadeOut('slow',function(){$(this).remove();});
});

      $('#signup').click(function() {
        $('html,body').animate({
          scrollTop : $('.registercontainer').offset().top
        }, 1000);
      });
     });
    </script>
</body>
</html>

<script type="text/javascript">
    $("button#submit").click(function(event) {
        event.preventDefault();
        var username =document.getElementById('username').value;
        var fname =document.getElementById('fname').value;
        var lname =document.getElementById('lname').value;
        var email =document.getElementById('email').value;
        var pass =document.getElementById('pass1').value;
        var passw=document.getElementById('pass2').value;

        if(username=="" || fname=="" || lname=="" || email=="" || pass=="" || passw=="")
        {
          alert("Please Fill all the fields");
        }
        else if(pass!=passw){
          alert('Passwords Donot Match');
        }
        else{
        $.ajax({
          type : 'POST',
          url : 'ajaxregister.php',
          data : {
            username : username,
            fname : fname,
            lname : lname,
            email : email,
            pass : pass
          },
          cache : false,
          success : function(data) {
            alert(data);
            console.log(data);
            document.getElementById("cform").reset();
          }
        });}
      });
    

</script>

