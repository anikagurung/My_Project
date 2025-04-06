<?php 
include_once("header2.php");
session_start();

include_once("config.php");


// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: /project4/login.php"); // Redirect to login page if not logged in
    exit();
}

// Get the user ID from the session
$userId = $_SESSION['id'];

// Retrieve the seller ID from the database based on the user ID
$sql = "SELECT id FROM seller WHERE user_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 1) {
    $stmt->bind_result($sellerId);
    $stmt->fetch();
} else {
    // Handle the case where the user is not registered as a seller
    $notRegisteredMessage = "You are not registered as a seller.";
}

$stmt->close();

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $authorname = $_POST['authorname'];
    $price = $_POST['price'];

    // File upload handling
    $target_dir = "../admin/uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType !="webp"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // Insert product details into the product table with status "pending"
            $status = "pending"; // Set status to "pending"
            $sql = "INSERT INTO product (title, authorname, price, photo, seller_id, status) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ssssis", $title, $authorname, $price, $target_file, $sellerId, $status);
                if ($stmt->execute()) {
                    // Product added successfully
                    echo '<script>alert("Product added successfully. Your product is now pending approval.");';
                    echo 'window.location.href = "userinfo.php";</script>';
                    exit(); // Prevents showing the form again after success
                } else {
                    echo "Error executing query: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing statement: " . $mysqli->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .containerr {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            background-color: #f8d7da;
            color: red;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            display: inline-block;
            min-width: 200px;
        }
    </style>
</head>
<body>
   <br> <a href="userinfo.php" style="margin-left: 400px;"><i class="fa-solid fa-xmark" style="color: black; border: solid;"></i></a>
    <div class="containerr">
        <h2>Add Book</h2>
        <?php if(isset($notRegisteredMessage)): ?>
            <div class="message"><?php echo $notRegisteredMessage; ?></div>
        <?php else: ?>
            <form action="addbook.php" method="post" enctype="multipart/form-data">
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" required><br><br>
                
                <label for="authorname">Author Name:</label><br>
                <input type="text" id="authorname" name="authorname" required><br><br>
                
                <label for="price">Price:</label><br>
                <input type="text" id="price" name="price" required><br><br>
                
                <label for="photo">Photo:</label><br>
                <input type="file" id="photo" name="photo" accept="image/*"><br><br>
                
                <input type="submit" name="submit" value="Add Book">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
<?php include_once("footer.php");?>
