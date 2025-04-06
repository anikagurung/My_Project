<?php
session_start();
$message="";
$id=null;
    if(isset($_POST['submit'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
    include_once("config.php");
        $result=mysqli_query($mysqli,"SELECT id,email,password,role FROM user WHERE email='$email' && password='$password'");
        if($result&&mysqli_num_rows($result)>0){
            while($user=mysqli_fetch_array($result)){
                $id=$user["id"];
                $role=$user["role"];

                $_SESSION['id']=$id;
                $_SESSION['role']=$role;
                echo 'User ID set in session:'.$id.'<br>';
                echo 'User ID set in session:'.$role.'<br>';

                echo 'Session ID:'.session_id().'<br>';
                if($role=="user"){          
              
                  header("Location:/project4");               
              
              }if($role=="admin"){
              
                      header("Location:/project4/admin");
                      }
                   
           exit();
        }
    }
        else{
            $message="Your username or password didnot match";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Second life of books</title>
    <link rel="stylesheet" href="login.css">
</head>
<style>

body {font-family: Arial, Helvetica, sans-serif;}


input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color:rgba(230, 216, 186, 0.916) ;
  color: black;
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
  background-color:indianred;
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


   
<body>
  <center>
    <h2>Login Form</h2>
  </center>
     <center>
    <form action="login.php" method="post" >
      <fieldset style="width:500px;"><legend> User information </legend><br>



     <div class="container">
    <label for="uname"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <i class="fa fa-lock"></i>
    <input type="password" placeholder="Enter Password" name="password" required>
        <a href="home.html">
    <button type="submit" name="submit">Login</button></a>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>
  <div style="color:red;"><?php echo $message;?></div>

   <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button><br>
    <!--<span class="psw">Forgot <a href="#">password?</a></span>--><br>
     <span class="acc">Don't have an account? <a href="register.php">Sign Up</a></span>
    </div>
   
    </form>
    
 </font>    <br>




</center>
</fieldset>
</form>
</center>


</body>
</html>