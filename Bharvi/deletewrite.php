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
  $sql="DELETE from category_table where username='$uname' and category='writing';";
  $result=mysqli_query($db,$sql);
  echo "<script> alert('Deleted');</script>";
  header("location:userindex.php");

?>