<?php
session_start();
$message="";
$id=null;
    if(isset($_POST['submit'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
    include_once("config.php");
        $result=mysqli_query($mysqli,"SELECT id, email,password FROM admin WHERE email='$email' && password='$password'");
        if($result&&mysqli_num_rows($result)>0){
            while ($user=mysqli_fetch_array($result)) {
                 $id = $user['id'];
    $_SESSION['id'] = $id;

    echo 'User ID set in session: ' . $id . '<br>';
    echo 'Session ID: ' . session_id() . '<br>';

           header("Location:index.php");
           exit();
       }
        }
        else{
            $message="Your username or password didnot match";

        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}



.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<center>
<form action="adminlogin.php" method="post" style="width:50%;">

  

  <div class="container">
    <label for="email"><b>Email</b></label>
    <input type="text"  name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password"  name="password" required>
        
    <button type="submit" name="submit">Login</button>
     </div>
       <div style="color:red;"><?php echo $message; ?></div>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>

</body>
</html>