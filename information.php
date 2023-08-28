<?php
session_start();
if(isset($_SESSION['username'])){
  echo "user name".$_SESSION['username']."<br>";
  echo "password".$_SESSION['password']."<br>";
  echo "Email".$_SESSION['email']."<br>";  
}
else{
    echo "Please login to continue";
}


?>