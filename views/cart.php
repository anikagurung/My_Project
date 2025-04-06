<?php
session_start();
include('header2.php');
include('config.php');
$uuid = $_SESSION['id'];

// Fetch products from the cart, grouping them by product and summing the quantities
$product_query = mysqli_query($mysqli, "SELECT product.*, SUM(cart.quantity) AS total_quantity FROM cart INNER JOIN product ON cart.product = product.id WHERE cart.user = $uuid GROUP BY cart.product");

if (!empty($product_query)) {
    while ($row = mysqli_fetch_array($product_query)) {
        ?>
        <div class="product">
            <div class="product-image"><img src="../admin/<?php echo $row["photo"]; ?>"></div>
            <div class="product-tile-footer">
                <div class="product-title"><?php echo $row["title"]; ?></div>
                <div class="product-title"><?php echo $row["authorname"]; ?></div>
                <div class="product-price"><?php echo "Rs" . $row["price"]; ?></div>
                <div class="product-quantity">Quantity: <?php echo $row["total_quantity"]; ?></div>
                <a href='delete.php?id=<?php echo $row["id"] ?>'>Remove from Cart</a>
            </div>
        </div>
        <?php
    }
} else {
    echo "No Records.";
}
?>
<div>
</div>
<center>
    <br>
    <?php
    $total = mysqli_query($mysqli, "SELECT SUM(price) FROM cart INNER JOIN product ON cart.product = product.id WHERE cart.user = $uuid");

    while ($buy = mysqli_fetch_array($total)) {
        echo " <h3>Total cost: " . $buy['SUM(price)'];
        echo "<br></h3>";
    }
    ?>
    <div style="padding-top:30px;bottom:30px;position:absolute; margin-left:45%;">
    </div>
</center>
<br>
<br>
<br>
<br>
<br>
<br>
<center>
    <h1><button>Buy Now</button></h1>
    <br>
    <br>
    <br>
    <br>
    <br>
</center>
<?php
include("footer.php");
?>
