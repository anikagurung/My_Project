<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['id'])) {
    header("Location:/project4");
    exit; // Stop execution if not logged in
}

// Ensure product ID is provided
if (!isset($_GET['id'])) {
    echo "Product ID not provided.";
    exit;
}

$productId = $_GET['id'];

// Delete the associated file from the server (if it exists)
$query = "SELECT photo FROM product WHERE id = $productId";
$result = mysqli_query($mysqli, $query);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $filePath = $row['photo'];
    if (file_exists($filePath)) {
        if (!unlink($filePath)) {
            echo "Error deleting file.";
            exit;
        }
    }
} else {
    echo "Product not found.";
    exit;
}
// Delete the product from the products table
$deleteQuery = "DELETE FROM product WHERE id = $productId";
if (!mysqli_query($mysqli, $deleteQuery)) {
    echo "Error deleting product from pending_products table: " . mysqli_error($mysqli);
    exit;
}else{
    echo '<script>alert("Product deleted successfully.");';
    echo 'window.location.href = "userinfo.php";</script>';
                    exit(); // Prevents showing the form again after success
}

mysqli_close($mysqli);
?>
