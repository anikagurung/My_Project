<?php
include_once("config.php");

$id= $_GET['id'];

$result = mysqli_query($mysqli,"DELETE FROM user where id=$id");

header("Location:indexuser.php");
?>