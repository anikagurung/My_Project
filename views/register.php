<?php
include 'config.php';
?>
<?php
$message = "";
include_once("config.php");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pswrepeat = $_POST['pswrepeat'];

    // Check if the email already exists
    $result = mysqli_query($mysqli, "SELECT email FROM user WHERE email='$email'");
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email is already registered');</script>";
    } else {
        if ($password == $pswrepeat) {
            $result = mysqli_query($mysqli, "INSERT INTO user (email, password, role, pswrepeat) VALUES ('$email', '$password','user', '$pswrepeat')");
            if ($result) {
                echo"<script> alert('You are added successfully..');</script>";

                // Redirect to the login page after a delay
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    });
                </script>";
            } else {
                $message = "Registration failed. Please try again.";
            }
        } else {
            $message = "Passwords do not match.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">
        function formsubmit() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var pswrepeat = document.getElementById('pswrepeat').value;
            var a = email.lastIndexOf('@');
            var b = email.lastIndexOf('.');
            if (a <= 0 || (b - a) <= 1) {
                document.getElementById('msg').innerHTML = "<font color=red> Please enter a valid email address</font>";
                return false;
            } else if (password !== pswrepeat) {
                document.getElementById('msg').innerHTML = "<font color=red>Passwords do not match</font>";
                return false;
            } else {
                document.form1.submit();
                return true;
            }
        }
    </script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: whitesmoke;
        }

        * {
            box-sizing: border-box;
        }

        /* Add padding to containers */
        .container {
            padding: 16px;
            background-color: white;
        }

        /* Full-width input fields */
        input[type=text], input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Overwrite default styles of hr */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* Set a style for the submit button */
        .registerbtn {
            background-color: rgba(230, 216, 186, 0.916);
            color: black;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .registerbtn:hover {
            opacity: 1;
            background-color: palevioletred;
        }

        /* Add a blue text color to links */
        a {
            color: dodgerblue;
        }

        /* Set a grey background color and center the text of the "sign in" section */
        .signin {
            background-color: #f1f1f1;
            text-align: center;
        }

        form {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<center>
    <form action="register.php" method="post" name="form1">
        <div class="container">
            <h4>Register an account</h4>
            <hr>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter password" name="password" id="password" required>

            <label for="psw-repeat"><b>Re-type Password</b></label>
            <input type="password" placeholder="Password" name="pswrepeat" id="pswrepeat" required>
            <hr>
            <div id="msg"></div>
            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
            <button type="submit" class="registerbtn" name="submit" onclick="return formsubmit();">Register</button>
        </div>
        <div><?php echo $message; ?></div>
        <div class="container signin">
            <p>Already have an account? <a href="login.php">Login</a>.</p>
        </div>
    </form>
</center>



</body>
</html>
