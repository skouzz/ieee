<?php
session_start();
error_reporting(0);
include('config.php');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $Email = $_POST['Email'];
    $password = md5($_POST['password']);
    $sql = "INSERT INTO users(username, Email, password) VALUES(:username,:Email,:password)";
    $query = $db->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':Email', $Email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $db->lastInsertId();
    if ($lastInsertId) {
        $_SESSION['login']=$_POST['username'];
        echo "<script>alert('Your Regestration is Confirmed ')</script>";
        echo "<script type='text/javascript'> document.location = 'login.php'; </script>";

    } else {
        echo "<script>alert('Invalid Regestration ')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>signup</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <nav>
  <div class="logo"><a href="index.php"><img src="img/logowhite.png" alt="IEEE ESSTHS SB" width="200px"/></a>
</div>
 </nav>
    <div class="center">
      <h1>Signup</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" name="username"Placeholder="Username" required>
          <span></span>
        </div>
        <div class="txt_field">
          <input type="text" name="Email" Placeholder="Email"required>
          <span></span>
        </div>
        <div class="txt_field">
          <input type="password" name="password" Placeholder="Password" required>
        </div>
        <input  name="submit" type="submit" value="Signup">
        <div class="signup_link">
          Vous avez un compte ? <a href="login.php">Login</a>
        </div>
      </form>
     
    </div>

  </body>
</html>
