<?php
session_start();
error_reporting(0);
include('config.php');

if (isset($_POST['submit'])) {
    $Email = $_POST['Email'];
    $password = md5($_POST['password']);
    $sql = "SELECT id,username,Email FROM users WHERE Email=:Email and password=:password";
    $query = $db->prepare($sql);
    $query->bindParam(':Email', $Email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['login'] = $results->username;
        $_SESSION['user'] = $results->id;
        echo "<script>alert('Login Successful ! ')</script>";
        echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <nav>
   <div class="logo"><a href="index.php"><img src="img/logowhite.png" alt="IEEE ESSTHS SB" width="200px"/></a>
</div>
 </nav>
    <div class="center">
      <h1>Login</h1>
      <form  method="post">
        <div class="txt_field">
        <input type="text" name="Email" Placeholder="Email/Username" required="">
        </div>
        <div class="txt_field">
        <input type="password" name="password" Placeholder="Password" required="">
        </div>
        <div class="pass">Forgot Password?</div>
        <input  name="submit" type="submit" value="Login">
        <div class="signup_link">
          Not a member? <a href="Signup.php">Sign up</a>
        </div>
      </form>
    </div>

  </body>
</html>