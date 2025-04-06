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
/*include_once("config.php");
if (isset($_POST['submit'])) {

$title = $_POST['title'];
$authorname = $_POST['authorname'];
$price = $_POST['price'];
$photo = $_POST['photo'];

		$result = mysqli_query($mysqli, "INSERT INTO product(title,authorname,price,photo) VALUES('$title','$authorname','$price','$photo')");

		echo "product added successfully. <a href='indexproduct.php'>View Users</a>";
}*/
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Product</title>
    <style>
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
    <a href="indexproduct.php">Go to view products</a>
    <form action="addproduct.php" method="post" enctype="multipart/form-data">
        <center>
            <table width="50%" border="0">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" required></td>
                </tr>
                <tr>
                    <td>Author Name</td>
                    <td><input type="text" name="authorname" required></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="text" name="price" required></td>
                </tr>
                <tr>
                    <td>Photo</td>
                    <td><input type="file" name="photo" accept="image/*" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Add product"></td>
                </tr>
            </table>
        </center>
    </form>
</body>
</html>

<?php
include_once('includes/footer.php');
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $authorname = $_POST['authorname'];
    $price = $_POST['price'];

    // File upload handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) {
         echo '<script>alert("File is not an image.");';
            echo 'window.location.href = "indexproduct.php";</script>';
        //echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
         echo '<script>alert("Sorry, file already exists.");';
            echo 'window.location.href = "indexproduct.php";</script>';

        //echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo '<script>alert("Sorry, your file is too large.");';
            echo 'window.location.href = "indexproduct.php";</script>';
        //echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if (!in_array($imageFileType, array("jpg", "png", "jpeg", "gif", "webp"))) {
         echo '<script>alert("Sorry, only JPG, JPEG, PNG, GIF, and WEBP files are allowed.");';
            echo 'window.location.href = "indexproduct.php";</script>';
        //echo "Sorry, only JPG, JPEG, PNG, GIF, and WEBP files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // Insert product details into the database
            $sql = "INSERT INTO product (title, authorname, price, photo, status) VALUES (?, ?, ?, ?, 'approved')";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ssss", $title, $authorname, $price, $target_file);
            if ($stmt->execute()) {
                echo '<script>alert("Product added successfully.");';
                echo 'window.location.href = "indexproduct.php";</script>';
                exit(); // Prevents showing the form again after success
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo '<script>alert("Sorry, there was an error uploading your file.");';
            echo 'window.location.href = "indexproduct.php";</script>';
        }
    }
}
?>
</div>
    <?php
    include('includes/footer.php')
?>
