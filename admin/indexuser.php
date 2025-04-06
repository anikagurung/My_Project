<?php
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Registered users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<?php
include_once("config.php");
$result = mysqli_query($mysqli,"SELECT * from user");
?>
<!DOCTYPE html>
<html>
<head>
	
	<title>Homepage</title>
</head>
<body>
	<!--<a href="add.php">Add New User </a><br/><br/>-->
	<center>
	<h4> User Details</h4>
	<table width="70%" border="1" style="border-collapse: collapse;">
		<tr>
		 <td>Email</td><td>password</td><td>pswrepeat</td><td>is_seller</td>
		</tr>
		<?php
		while($user_data = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>".$user_data['email']."</td>";
			echo "<td>".$user_data['password']."</td>";
			echo "<td>".$user_data['pswrepeat']."</td>";
			echo "<td>".$user_data['is_seller']."</td>";

			//echo "<td><a href='edituser.php?id=$user_data[id]'>Edit</a> | <a href='deleteuser.php?id=$user_data[id]'>Delete</a></td></tr>";

		}
		?>
		
	</table>
</center>

</body>
</html>
</div>
<?php
    include('includes/footer.php')
?>