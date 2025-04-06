<?php
include_once("config.php");
if(isset($_POST['update']))
{
	$id = $_POST['id'];
	$email =$_POST['email'];
	$password = $_POST['password'];
	$pswrepeat = $_POST['pswrepeat'];


	$result= mysqli_query($mysqli,"UPDATE user SET email='$email',password='$password',pswrepeat='$pswrepeat' where id=$id");
	header("Location: index.php");
 

}
?>
<?php
$id= $_GET['id'];

$result = mysqli_query($mysqli,"SELECT * FROM user where id=$id");

while ($user_data = mysqli_fetch_array($result)) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$pswrepeat = $_POST['pswrepeat'];
	
}
?>

<!DOCTYPE html>
<html>
<head>
	
	<title>Edit User Data</title>
</head>
<body>
	<a href="indexuser.php">Home</a>
	<br/><br/>

	<form name="update_user" method="post" action="edituser.php">
		<table border="0">
			<tr>
			<td>Email</td>
				<td><input type="text" name="email" value="<?php echo $email;?>"></td>
			</tr>
			<tr>
				<td>password</td>
				<td><input type="password" name="password" value="<?php echo $password;?>"></td>
			</tr>
			<tr>
				<td>pswrepeat</td>
				<td><input type="password" name="pswrepeat" value="<?php echo $pswrepeat;?>"></td>
			</tr>
			<tr>
			
			<td><input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
			</td>
			<td> <input type="submit" name="update" value="Update"></td>
		 </tr>
			
		</table>
		
	</form>

</body>
</html>