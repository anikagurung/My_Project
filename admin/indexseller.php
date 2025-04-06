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
$result = mysqli_query($mysqli,"SELECT * from seller");
//$result = mysqli_query($mysqli, $result);
?>
<!DOCTYPE html>
<html>
<head>
	
	<title>Homepage</title>
	<style type="text/css">
		 td {
  padding: 15px;
  text-align: left;
}
	</style>
</head>
<body>

	<center>
	<h4>Seller Details</h4>

	<table width="80%" border="1" style="border-collapse: collapse;">
		<tr>

		 <td>Seller Id</td><td>User Id</td><td>Full Name</td><td>Contact</td>
		</tr>
		<?php
		while($user_data = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>".$user_data['id']."</td>";
			echo "<td>".$user_data['user_id']."</td>";
			echo "<td>".$user_data['fullname']."</td>";
			echo "<td>".$user_data['contact']."</td>";
			 //echo "<td><img src='" . $user_data['photo'] . "' alt='Product Photo' style='width: 50px; height: 50px;'></td>";
			

			//echo "<td><a href='editproduct.php?id=$user_data[id]'>Edit</a> | <a href='deleteproduct.php?id=$user_data[id]'>Delete</a></td></tr>";`
			 //echo "<td><a href='editproduct.php?id=$user_data[id]'>Edit</a>| <a href='productdelete.php?id=$user_data[id]'>Delete</a></td></tr>";


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