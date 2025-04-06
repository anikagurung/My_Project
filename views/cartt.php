<?php
session_start();
include('header2.php');
include('config.php');
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);
$userId = $_SESSION['id'];

// Check if the form to update quantity was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_quantity']) && isset($_POST['product_id'])) {
    $updateType = $_POST['update_quantity']; // Get whether to increase(+) or decrease(-) quantity
    $productId = $_POST['product_id']; // Get the product ID

    // Get the current quantity of the product in the cart
    $currentQuantityQuery = mysqli_query($mysqli, "SELECT quantity FROM cart WHERE user = $userId AND product = $productId");
    $currentQuantityRow = mysqli_fetch_assoc($currentQuantityQuery);
    $currentQuantity = $currentQuantityRow['quantity'];

    // Update quantity based on whether to increase(+) or decrease(-)
    if ($updateType == '+') {
        $newQuantity = $currentQuantity + 1;
    } elseif ($updateType == '-' && $currentQuantity > 1) {
        $newQuantity = $currentQuantity - 1;
    }

    // Update the quantity in the cart
    mysqli_query($mysqli, "UPDATE cart SET quantity = $newQuantity WHERE user = $userId AND product = $productId");
}

// Check if the product to remove from the cart was clicked
if(isset($_GET['remove_product_id'])) {
    $removeProductId = $_GET['remove_product_id'];
    // Remove the product from the cart
    mysqli_query($mysqli, "DELETE FROM cart WHERE user = $userId AND product = $removeProductId");
}
// Fetch the cart ID from the database
$cartIdQuery = mysqli_query($mysqli, "SELECT user FROM cart WHERE user = $userId");
$cartIdRow = mysqli_fetch_assoc($cartIdQuery);
$cartId = $cartIdRow['user'];

// Set the cart ID in the session
$_SESSION['cart_id'] = $cartId;


// Fetch products from the cart, grouping them by product and summing the quantities
$product_query = mysqli_query($mysqli, "SELECT product.*, cart.quantity AS total_quantity FROM cart INNER JOIN product ON cart.product = product.id WHERE cart.user = $userId");
?>

    <style>

        .containerr {
            margin-top: 50px;
        }
        .table {
            width: 100%;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }
        .float-right {
            float: right !important;
            font-size: 20px;
        }
button:hover{
    background-color:rgb(128, 128, 0);
}
button {
    display: inline-block;
    padding: 10px;
    border: none;
    border-radius: 20px;
    background-color: rgba(175, 137, 119, 0.781);
    color: white;
    text-align: left;
    text-decoration: none;
    font-size: 16px;
    cursor: pointer;
}
    </style>
</head>

<body>
    <div class="container">
        <div class="containerr">
           <center> <h4>Your Cart</h4></center>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalPrice = 0;
                        if (!empty($product_query)) {
                            while ($row = mysqli_fetch_array($product_query)) {
                                $itemPrice = $row["price"] * $row["total_quantity"];
                                $totalPrice += $itemPrice;

                                echo "<tr>";
                                echo "<td><img src='../admin/{$row["photo"]}' alt='Book Cover' style='max-width: 80px;'></td>";
                                echo "<td>{$row["title"]}</td>";
                                echo "<td>{$row["authorname"]}</td>";
                                echo "<td>Rs. {$row["price"]}</td>";
                                echo "<td>
                                    <form method='post' action=''>
                                        <input type='hidden' name='product_id' value='{$row["id"]}'>
                                        <button type='submit' class='btn btn-outline-primary' name='update_quantity' value='-'>-</button>
                                        <span class='px-2'>{$row["total_quantity"]}</span>
                                        <button type='submit' class='btn btn-outline-primary' name='update_quantity' value='+'>+</button>
                                    </form>
                                </td>";
                                echo "<td>Rs. $itemPrice</td>";
                                echo "<td><a href='cartt.php?remove_product_id={$row["id"]}'>Remove</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Records.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="float-right"><strong>Total Cost: Rs. <?php echo $totalPrice; ?></strong></div>
        <br><br>
        <?php //echo "Cart ID: {$_SESSION['cart_id']}";?>
        <div  class="float-right">

        <form action="order.php" method="post">
    <input type="hidden" name="cart_id" value="<?php echo $_SESSION["cart_id"]; ?>">
    <input type="hidden" name="total_price" value="<?php echo $totalPrice; ?>">
    <button type="submit" name="buy_now">Buy Now</button>
</form>
        <!--<div class="float-right"><button>Buy Now</button>--></div>
        <br><br><br><br>
   </div>
    <?php include("footer.php"); ?>
