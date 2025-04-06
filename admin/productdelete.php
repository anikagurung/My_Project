<?php
include_once("config.php");

// Check if product ID is provided in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch the photo filename from the database
    $photo_query = "SELECT photo FROM product WHERE id = $id";
    $photo_result = mysqli_query($mysqli, $photo_query);
    $photo_data = mysqli_fetch_assoc($photo_result);
    $photo_filename = $photo_data['photo'];

    // Delete the product from the database
    $delete_query = "DELETE FROM product WHERE id = $id";
    if(mysqli_query($mysqli, $delete_query)) {
        // Product deleted successfully from the database
        
        // Delete the associated photo file if it exists
        if(!empty($photo_filename) && file_exists($photo_filename)) {
            unlink($photo_filename); // Delete the file
        }

        // Redirect back to the product list page
        header("Location: indexproduct.php");
        exit;
    } else {
        // Error occurred while deleting the product
        echo "Error deleting product: " . mysqli_error($mysqli);
    }
} else {
    // Product ID is not provided in the URL, display an error message
    echo "Product ID is missing.";
}
?>
