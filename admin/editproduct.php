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
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $authorname = $_POST['authorname'];
    $price = $_POST['price'];

    $result = mysqli_query($mysqli, "SELECT * FROM product WHERE id = $id");
    $user_data = mysqli_fetch_assoc($result);
    $old_photo = $user_data['photo'];

    // Check if a new photo file is uploaded
    if ($_FILES['photo']['size'] > 0) {
        // Delete old photo if it exists
        if (!empty($old_photo)) {
            unlink($old_photo); // Delete the old photo file
        }
        // Upload the new photo
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // Update product details in the database with new photo path
            $photo_path = $target_file;
            $sql = "UPDATE product SET title = ?, authorname = ?, price = ?, photo = ? WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ssssi", $title, $authorname, $price, $photo_path, $id);
            if ($stmt->execute()) {
                echo '<script>alert("Product updated successfully.");';
                echo 'window.location.href = "indexproduct.php";</script>';
                exit();
            } else {
                echo "Error updating product: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        // If no new photo is uploaded, retain the existing photo path
        $sql = "UPDATE product SET title = ?, authorname = ?, price = ? WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssi", $title, $authorname, $price, $id);
        if ($stmt->execute()) {
            echo '<script>alert("Product updated successfully.");';
            echo 'window.location.href = "indexproduct.php";</script>';
            exit();
        } else {
            echo "Error updating product: " . $stmt->error;
        }
        $stmt->close();
    }
}

$id = $_GET['id'];
$result = mysqli_query($mysqli,"SELECT * FROM product WHERE id = $id");
$user_data = mysqli_fetch_assoc($result);
$title = $user_data['title'];
$authorname = $user_data['authorname'];
$price = $user_data['price'];
$photo = $user_data['photo'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product Details</title>
    <style type="text/css">
        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <a href="indexproduct.php" style="margin-left: 30px;"><i class="fa-solid fa-xmark" style="color: black; border: solid;"></i></a>
    <br/><br/>
    <center>

    <form name="update_user" method="post" action="editproduct.php" enctype="multipart/form-data">
        <table width="80%" border="0" style="border-collapse: collapse;">
            <tr>
                <td>Title</td>
                <td><input type="text" name="title" value="<?php echo $title;?>" required></td>
            </tr>
            <tr>
                <td>Author Name</td>
                <td><input type="text" name="authorname" value="<?php echo $authorname;?>" required></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="text" name="price" value="<?php echo $price;?>" required></td>
            </tr>
            <tr>
                <td>Photo</td>
                <td>
                    <?php if (!empty($photo)): ?>
                        <img src="<?php echo $photo; ?>" alt="Product Photo" style="width: 50px; height: 50px;"><br>
                    <?php endif; ?>
                    <input type="file" name="photo" accept="image/*">
                </td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</center>
</body>
</html>
</div>
    <?php
    include('includes/footer.php')
?>
