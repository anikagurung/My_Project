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
session_start();

include_once("config.php");

// Check if admin is logged in
// if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
//     header("Location: admin_login.php");
//     exit();
// }

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch pending products posted by sellers that are not approved or rejected
$result = mysqli_query($mysqli, "SELECT * FROM orders");
//$result = mysqli_query($mysqli, "SELECT product.*, cart.quantity AS total_quantity FROM cart INNER JOIN product ON cart.product = product.id WHERE cart.user = $cart_id");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        /* Add your custom styles here */
        td {
            padding: 20px;
            text-align: center;
        }
        th{
            text-align: center;
        }
    </style>
</head>
<body>
    <center>
    <h3><strong>Order Details</strong></h3>
    <table width="80%" border="1" style="border-collapse:collapse;">
        <tr>
            <th>Order Id</th>
            <th>Total Price</th>
            <th>User Id</th>
            
        </tr>
        <?php
        // Display pending products
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['orderid']; ?></td>
                <td><?php echo $row['total_price']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
                
            </tr>
            <?php
        }
        ?>
    </table>
</center>

    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
</div>
<?php
    include('includes/footer.php')
?>
