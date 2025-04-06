<?php
session_start();
$uid=$_SESSION['id'];
$productid=$_GET ['id'];
echo"$productid";
echo"<br>";
echo"$uid";
include('config.php');
// include('/project4');

$result=mysqli_query($mysqli,"DELETE FROM cart WHERE user='$uid' AND product='$productid'");
header("Location:cart.php");

?>