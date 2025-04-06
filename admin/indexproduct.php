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
$result = mysqli_query($mysqli,"SELECT * from product WHERE status='approved'");
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
	<h4> Product Details</h4>
	<a href="addproduct.php" class="btn btn-success">Add Product</a>
	<table width="80%" border="1" style="border-collapse: collapse;">
		<tr>

		 <td>Id</td><td>Title</td><td>Authorname</td><td>Price</td><td>Photo</td><td>Seller Id</td> <td>Update</td>
		</tr>
		<?php
		while($user_data = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>".$user_data['id']."</td>";
			echo "<td>".$user_data['title']."</td>";
			echo "<td>".$user_data['authorname']."</td>";
			echo "<td>".$user_data['price']."</td>";
			 echo "<td><img src='" . $user_data['photo'] . "' alt='Product Photo' style='width: 50px; height: 50px;'></td>";
			 echo "<td>".$user_data['seller_id']."</td>";
			

			//echo "<td><a href='editproduct.php?id=$user_data[id]'>Edit</a> | <a href='deleteproduct.php?id=$user_data[id]'>Delete</a></td></tr>";`
			 echo "<td><a href='editproduct.php?id=$user_data[id]'>Edit</a>| <a href='productdelete.php?id=$user_data[id]'>Delete</a></td></tr>";


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