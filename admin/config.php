<?php
$databasehost= "localhost";
$databasename = "project";
$databaseusername = "root";
$databasepassword = "";


$mysqli = mysqli_connect($databasehost,$databaseusername,$databasepassword,$databasename);

if(!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "connected successfully..";
?>