<?php
 /*include_once('config.php');
 $result = mysqli_query($mysqli, "SELECT * FROM admin");
 $userId = $_SESSION['id'];
 if (!isset($userId)) {
    include("header.php");
 }else{
    include("header2.php");
 }*/
?>
<?php
session_start();
include_once('config.php');

// Check if the user is logged in
$userId = $_SESSION['id'];

if (isset($userId)) {
    // User is logged in, include header2.php
    include("header2.php");
} else {
    // User is not logged in, include header.php
    include("header.php");
}

// Fetch contact details from the database
$result = mysqli_query($mysqli, "SELECT * FROM admin");
?>

    <style>
        /* Your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;

        }

        .container-fluid {
            padding: 20px;
            /*background-color: rgba(230, 216, 186, 0.916);*/
        }

        h2 {
            text-align: center;
            font-family: sans-serif;
            color: brown;
        }

        .contact-details {
            margin-bottom: 30px;
            padding: 20px;
            /*background-color: #f9f9f9;*/
            border-radius: 10px;
            /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);*/

        }

        .contact-details h3 {
            margin-top: 0;
        }

        .contact-details p {
            margin-bottom: 5px;
        }

        .contact-details .fa {
            margin-right: 10px;
        }

        form {

            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: brown;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h2>Contact Us</h2><br>
        <div class="row">
            <div class="col-md-6">
                <!-- Admin contact details -->
                <div class="contact-details">
                     <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                ?>
                    <h3>Need help?</h3>
                    <h4>Contact:</h4><br>
               
                    <p><i class="fas fa-envelope"></i> info@secondlife.com<?php //echo $user_data['email']; ?> </p><br>
                    <p><i class="fas fa-phone"></i>+977-9821212344<?php //echo $user_data['phone']; ?></p>
                    <?php
                }
                ?>
                </div>
            </div>
            <div class="col-md-6">
                <!-- User feedback form -->
                <form method="post" action="">
    

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required><br><br>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br><br>

                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>

                    <input type="submit" name="submit" value="Submit">
                   <div id="msg">
                    <font color="black"><?php echo $message; ?></font>
                       
                   </div>

                </form>
            </div>
        </div>
    </div>

    <?php
    include_once("footer.php");
?>
<?php

error_reporting(E_ALL);
include_once("config.php");
if (isset($_POST['submit'])) {

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];


		$result = mysqli_query($mysqli, "INSERT INTO contact(name,email,message) VALUES('$name','$email','$message')");
        if ($result) {
        echo "<script>alert('Your message has been submitted successfully.');</script>"; // Display alert box
    } else {
        echo "<script>alert('Error: " . mysqli_error($mysqli) . "');</script>"; // Display alert box with error message
    }

		//echo "Your message sent successfully.";
}
?>
