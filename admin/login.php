<?php
?>
<?php
session_start();
$message = "";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    include_once("config.php");

    // Check user credentials and role
    $result = mysqli_query($mysqli, "SELECT id, email, password, role FROM user WHERE email='$email' AND password='$password' AND role='admin'");

    if ($result && mysqli_num_rows($result) > 0) {
        // If an admin user is found, set session and redirect
        $user = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: /project4/admin");
        exit();
    } else {
        // Display error message if login is unsuccessful
        $message = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <center>
        <h2>Login Form</h2>
    </center>
    <br>
    <form action="login.php" method="post">
        <fieldset style="width: 500px;">
            <legend>Admin Login</legend>
            <br>
            <div class="container">
                <label for="admin_email"><b>Email</b></label><br>
                <input type="text" placeholder="Enter Email" name="email" required><br><br>
                <label for="admin_password"><b>Password</b></label>
                <i class="fa fa-lock"></i><br>
                <input type="password" placeholder="Enter Password" name="password" required>
                <button type="submit" name="submit">Login as Admin</button>
                <div style="color: red;"><?php echo $message; ?></div>
            </div>
        </fieldset>
    </form>
</body>
</html>
