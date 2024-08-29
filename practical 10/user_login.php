<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <title>User Login</title>
</head>
<body>
<div class="form">
 <h1>User Log In</h1>
 <?php if(isset($errors['login'])):?>
    <p style "color: red;"><?php echo $errors['login'];?> </p>
<?php endif;?>
 <form action="" method="post" name="login">
 <input type="text" name="username" placeholder="Username" required><br>
 <input type="password" name="password" placeholder="Password" required><br>
 <input name="submit" type="submit" value="Login">
 </form>
 <p>Not registered yet? <a href='user_registration.php'>Register Here</a></p>
</div>
</body>
</html>
<?php
session_start();
require('database.php');
$errors = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $username = $_POST['username'];
 $password = $_POST['password'];
 if (authenticate($username, $password)) {
 $_SESSION['user_id'] = getUserID($username);
 $_SESSION['account_id'] = getAccountID($username);
 $_SESSION['username'] = $username;
 if ($_SESSION['account_id'] == 1) {
 header("Location: lecturer.php");
 exit();
 } elseif ($_SESSION['account_id'] == 2) {
 header("Location: student.php");
 exit();
 }
 } else {
 $errors['login'] = "Incorrect username or password. Please try again.";
 }
}
function authenticate($username, $password) {
    global $con;
    $query = "SELECT password FROM `users` WHERE username=?";
    $statement = $con->prepare($query);
    $statement->bind_param("s", $username);
    $statement->execute();
    $result = $statement->get_result();
    if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    return password_verify($password, $user['password']);
} else {return false;
}
}
function getUserID($username) {
    global $con;
    $query = "SELECT id FROM `users` WHERE username=?";
    $statement = $con->prepare($query);
    $statement->bind_param("s", $username);
    $statement->execute();
    $result = $statement->get_result();
    if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    return $user['id'];
    } else {
    return null;
    }
   }function getAccountID($username) {
    global $con;
    $query = "SELECT account_id FROM `users` WHERE username=?";
    $statement = $con->prepare($query);
    $statement->bind_param("s", $username);
    $statement->execute();
    $result = $statement->get_result();
    if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    return $user['account_id'];
    } else {
    return null;
    }
   }
   ?>