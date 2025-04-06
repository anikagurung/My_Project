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

// Check if approve button is clicked
if(isset($_POST['approve'])) {
    $productId = $_POST['approve'];
    $status = 'approved';
    $updateQuery = "UPDATE product SET status='$status' WHERE id=$productId";
    mysqli_query($mysqli, $updateQuery);
}

// Check if reject button is clicked
if(isset($_POST['reject'])) {
    $productId = $_POST['reject'];
    $status = 'rejected';
    $updateQuery = "UPDATE product SET status='$status' WHERE id=$productId";
    mysqli_query($mysqli, $updateQuery);
}

$result = mysqli_query($mysqli,"SELECT * from product WHERE status='pending'");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <style type="text/css">
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Product Details</h2>
    <!--<a href="addproduct.php" style="display: block; text-align: center; margin-bottom: 20px;">Add Product</a>-->
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author Name</th>
            <th>Price</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
        <?php
        while($user_data = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>".$user_data['id']."</td>";
            echo "<td>".$user_data['title']."</td>";
            echo "<td>".$user_data['authorname']."</td>";
            echo "<td>".$user_data['price']."</td>";
            echo "<td><img src='" . $user_data['photo'] . "' alt='Product Photo'></td>";
            echo "<td>";
            echo "<form method='post' action=''>";
            echo "<button type='submit' name='approve' value='".$user_data['id']."'>Approve</button>";
            echo "<button type='submit' name='reject' value='".$user_data['id']."'>Reject</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>

    </div>
<?php
    include('includes/footer.php')
?>
