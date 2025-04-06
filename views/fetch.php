<?php
include_once('config.php');
include_once('header.php');

$result = mysqli_query($mysqli, "SELECT * FROM product");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Store</title>
    <link rel="stylesheet" type="text/css" href="CSS/home.css">
</head>
<body>
    <div class="container mt-3">
        <h2 style="padding-top: 20px; font-style: italic;">It's Book O' Clock</h2>
        <p>Explore our book options and find your next favorite book at the best prices.</p>
        <center>
            <div class="new-arrival">
                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="product">
                        <img src="<?php echo $user_data['photo']; ?>" alt="Book 1">
                        <div class="product-title"><?php echo $user_data['title']; ?></div>
                        <p><?php echo $user_data['authorname']; ?> </p>
                        <div class="product-price"><?php echo $user_data['price']; ?></div>
                        <button class="add-to-cart" onclick="addToCart()">Add to Cart</button>
                    </div>
                <?php
                }
                ?>
            </div>
        </center>
    </div>
</body>
</html>
<?php
include_once('footer.php');
?>

<?php
// Close the database connection
$mysqli->close();

?>
