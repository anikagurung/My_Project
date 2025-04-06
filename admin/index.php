<?php

// session_destroy();

session_start();





if( $_SESSION["id"]){
  
  include("home.php");

  
  // $password=$_SESSION["password"]; 
  }
 
else
    header("Location:/project4");
 



?>

 