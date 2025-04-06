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

// Fetch pending products posted by sellers
$result = mysqli_query($mysqli, "SELECT * FROM cart JOIN product ON product.id=cart.product");
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
            text-align: left;
        }
    </style>
</head>
<body>
    <center>
    <h4>Cart Details</h4>
    <table width="70%" border="1" style="border-collapse:collapse;">
        <tr>
            <th>Cart Id</th>
            <th>User Id</th>
            <th>Product Id</th>
            <th>Quantity</th>
            <th>Photo</th>
        </tr>
        <?php
        // Display pending products
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['user']; ?></td>
                <td><?php echo $row['product']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><img src="<?php echo $row['photo']; ?>" alt="Product Photo" style="max-width: 50px;"></td>
                <!--<td>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="action" value="approve">
                        <button type="submit">Approve</button>
                    </form>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="action" value="reject">
                        <button type="submit">Reject</button>
                    </form>
                </td>-->
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
