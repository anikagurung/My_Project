<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="styles.css">
    <style>
        .order-success {
            margin-bottom: 20px;
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            border-radius: 4px;
            padding: 15px;
            text-align: center;
        }

        .order-products {
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .product-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow: hidden;
        }

        .product-item img {
            max-width: 100px;
            float: left;
            margin-right: 10px;
        }

        .product-details {
            float: left;
        }

        .product-details h4 {
            margin-top: 0;

        }

        .total-price {
            margin-top: 20px;
            text-align: center;
        }

        .payment-options {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .payment-logo {
            max-width: 100px;
            margin: 0 10px;
        }
    </style>
</head>
<body>

<?php
session_start();
include('header2.php');
include('config.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form for buying now was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buy_now'])) {
    // Get cart ID and total price from the form
    $cart_id = isset($_POST['cart_id']) ? $_POST['cart_id'] : null;
    $total_price = isset($_POST['total_price']) ? $_POST['total_price'] : null;

    // Validate cart ID and total price
    if ($cart_id !== null && $cart_id !== '' && is_numeric($cart_id) && $total_price !== null) {
        // Insert order into the database
        $insert = "INSERT INTO orders (user_id, total_price) VALUES ('$cart_id', '$total_price')";

        // Execute query
        if (mysqli_query($mysqli, $insert)) {
            // Order successfully placed
            //echo "<div class='order-success'>Your order has been placed successfully!</div>";


            // Fetch products associated with the order
            $product_query = mysqli_query($mysqli, "SELECT product.*, cart.quantity AS total_quantity FROM cart INNER JOIN product ON cart.product = product.id WHERE cart.user = $cart_id");

            // Display the products
            if (!empty($product_query)) {
                echo "<br><br><div class='order-products'>";
                echo "<h3>Products Ordered:</h3>";
                while ($row = mysqli_fetch_array($product_query)) {
                    $itemPrice = $row['price'] * $row['total_quantity'];
                    ?>
                    <div class="product-item">
                        <img src="../admin/<?php echo $row['photo']; ?>" alt="Product Photo">
                        <div class="product-details">
                            <h5 style="font-weight: bold;"><?php echo $row['title']; ?></h5>
                            <p style="font-weight: bold;">Price: Rs. <?php echo $row['price']; ?></p>
                            <p style="font-weight: bold;">Quantity: <?php echo $row['total_quantity']; ?></p>
                            <p style="font-weight: bold;">Total Price: Rs. <?php echo $itemPrice; ?></p>
                        </div>
                    </div>
                    <?php
                }
                echo "</div>";

                // Display the total price of the order
                echo "<div class='total-price'>";
                echo "<h3><strong>Total Price: Rs. $total_price</strong></h3>";
                echo "<p style='font-weight: bold;'>Pay via:</p>";
                echo "<div class='payment-options'>";
                // Insert logos for payment options
                echo "<img src='book/esew.png' class='payment-logo' alt='eSewa'>";
                echo "<img src='book/khalti.png' class='payment-logo' alt='Khalti'>";
                echo "<img src='book/fone.png' class='payment-logo' alt='FonePay'>";
                echo "</div>";
                echo "</div>";
            } else {
                echo "No products found for this order.";
            }
        } else {
            // Error occurred while placing order
            echo "Error placing order: " . mysqli_error($mysqli);
        }
    } else {
        // Handle invalid or missing cart ID or total price
        echo "Invalid or missing cart ID or total price.";
    }
}
?>
<br><br>
<?php include('footer.php'); ?>

</body>
</html>
