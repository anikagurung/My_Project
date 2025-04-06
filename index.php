<?php

//session_destroy();

session_start();

//if( $_SESSION["id"]){
  
 //header("Location:views/home2.php");

  
   //$password=$_SESSION["password"]; 
 // }
 
//else
   // header("Location:views/home.php");
$id = $_SESSION['id'];
$role = $_SESSION['role'];
if ($role=="user") {
  header("Location:views/home2.php");
}
if ($role=="admin") {
  header("Location:/project4/admin");
}
if ($role =="") {
header("Location:views/home.php");
}
 



?>

 