<?php
include "header2.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 600px;
        }
        h2 {
            color: #333;
        }

        strong {
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>

<div class="profile-container">
    <?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['id'])) {
        header("Location:/project4");
        exit; // Stop execution if not logged in
    }

    $userId = $_SESSION['id'];
    $role = $_SESSION['role'];

    include_once("config.php");

    // Fetch user information from the database
    $userQuery = "SELECT * FROM user WHERE id = $userId";
    $userResult = mysqli_query($mysqli, $userQuery);

    if ($userResult && $user = mysqli_fetch_assoc($userResult)) {
        // Display user information
        echo '<h2>Welcome, ' . $user['email'] . '!</h2>';
        echo '<strong>User ID:</strong> ' . $user['id'] . '<br>';
        echo '<strong>Email:</strong> ' . $user['email'] . '<br>';
        echo '<strong>Role:</strong> ' . $role. '<br>';

        // Check if the user is a seller
        $sellerCheckQuery = "SELECT * FROM seller WHERE user_id = $userId";
        $sellerCheckResult = mysqli_query($mysqli, $sellerCheckQuery);

        if ($sellerCheckResult && mysqli_num_rows($sellerCheckResult) > 0) {
            // User is a seller
            echo '<p>You are also a seller.</p>';

            // Fetch and display the products posted by the seller from the product table
           //$productsQuery = "SELECT * FROM product WHERE seller_id = $userId";

            // Fetch and display the products posted by the seller from the pending_products table
              $productsQuery = "SELECT product.*, seller.user_id FROM product 
                  JOIN seller ON product.seller_id = seller.id 
                  WHERE seller.user_id = $userId";



            $productsResult = mysqli_query($mysqli, $productsQuery);

            if ($productsResult) {
                if (mysqli_num_rows($productsResult) > 0) {
                    echo '<h3>Your Products:</h3>';
                    echo '<table>';
                    echo '<tr><th>Title</th><th>Author Name</th><th>Price</th><th>Status</th><th>Action</th></tr>';
                    while ($product = mysqli_fetch_assoc($productsResult)) {
                        echo '<tr>';
                        echo '<td>' . $product['title'] . '</td>';
                        echo '<td>' . $product['authorname'] . '</td>';
                        echo '<td>' . $product['price'] . '</td>';
                        echo '<td>' . $product['status'] . '</td>';
                        echo '<td><a href="delete_product.php?id=' . $product['id'] . '">Delete</a>|<a href="edit_product.php?id=' . $product['id'] . '">Edit</a></td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>No products found for this user.</p>';
                }
            } else {
                echo 'Error fetching products: ' . mysqli_error($mysqli);
            }
        } else {
            // If not a seller, provide a link to become a seller
            echo '<p>You are not registered as a seller. <a href="becomeseller.php">Join as Seller</a></p>';
        }
    } else {
        echo 'Error fetching user information: ' . mysqli_error($mysqli);
    }
    ?>
</div><br>
<center>
<div class="container">
    <a href="addbook.php">Want to add books?</a>
</div>
<br>
<br>
<a href="logout.php">Logout</a><br><br>
</center>
</body><br>
</html>
<body>
    <footer class="footer">
        <?php
        include('footer.php');?>
    </footer>
</body>

