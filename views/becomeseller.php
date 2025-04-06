<?php
session_start();
include_once("config.php");

$message = "";

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

    // Check if the user is already a seller
    $checkSellerQuery = "SELECT * FROM seller WHERE user_id = $userId";
    $checkSellerResult = mysqli_query($mysqli, $checkSellerQuery);

    if (mysqli_num_rows($checkSellerResult) > 0) {
        $message = "You are already registered as a seller. You cannot register again.";
    } else {
        // Assuming the form submits a POST request with a field named 'become_seller'
        if (isset($_POST['become_seller'])) {
            // Validate and sanitize form input
            $fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
            $contact = mysqli_real_escape_string($mysqli, $_POST['contact']);

            // Construct the SQL UPDATE query
            $updateQuery = "UPDATE user SET is_seller = 1 WHERE id = $userId";

            // Execute the query
            if (mysqli_query($mysqli, $updateQuery)) {
                // Insert additional information into the seller table
                $insertQuery = "INSERT INTO seller (user_id, fullname, contact) VALUES ($userId, '$fullname', '$contact')";
                if (mysqli_query($mysqli, $insertQuery)) {
                    $message = "User information updated successfully. You are now a seller!";
                    // Redirect to userinfo.php
                    echo '<script>alert("' . $message . '");';
                    echo 'window.location.href = "userinfo.php";</script>';
                    exit();
                } else {
                    $message = "Error inserting seller information: " . mysqli_error($mysqli);
                }
            } else {
                $message = "Error updating user information: " . mysqli_error($mysqli);
            }
        }
    }
} else {
    $message = "User not logged in.";
}
?>
<?php
include "header2.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a Seller</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .containerr {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: calc(100% - 16px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            color: #ff0000;
        }
    </style>
</head>
<body>
    <div class="containerr">
        <h2>Become a Seller</h2>
        <form action="becomeseller.php" method="post">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>
            
            <label for="contact">Contact Number:</label>
            <input type="text" id="contact" name="contact" required>
            
            <input type="submit" name="become_seller" value="Become a Seller">
        </form>
        <div class="message"><?php echo $message; ?></div>
    </div>

</body>
<?php include_once("footer.php");?>

