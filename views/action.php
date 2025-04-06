<?php
session_start();
$uid = $_SESSION['id'];
$productid = $_GET['id'];

include('config.php');

// Check if the product already exists in the cart
$result = mysqli_query($mysqli, "SELECT * FROM cart WHERE user = '$uid' AND product = '$productid'");
if (mysqli_num_rows($result) > 0) {
    // If the product exists, update the quantity
    $row = mysqli_fetch_assoc($result);
    $newQuantity = $row['quantity'] + 1;
    mysqli_query($mysqli, "UPDATE cart SET quantity = '$newQuantity' WHERE user = '$uid' AND product = '$productid'");
} else {
    // If the product doesn't exist, insert a new row with quantity 1
    mysqli_query($mysqli, "INSERT INTO cart (user, product, quantity) VALUES ('$uid', '$productid', 1)");
}
$_SESSION['cart_id'] = mysqli_insert_id($mysqli);
// Redirect back to the referring page
if(isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    // If referring page is not available, redirect to a default page
    header("Location: /project4/home2.php");
}
exit; // Make sure to exit after redirection
?>
