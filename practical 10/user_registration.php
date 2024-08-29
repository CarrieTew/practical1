<!DOCTYPE html>
<?php
require('database.php');
$errors = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $raw_password = trim($_POST['password']);
    $password = password_hash($raw_password, PASSWORD_DEFAULT);
    $address = $_POST['address'];
    $phone_no = $_POST['phone_no'];
    $account_id = $_POST['account_id'];
    //Form submission and handle the user's input
    if (!preg_match("/^[a-zA-Z\s]+$/", $full_name)) {
        $errors['full_name'] = "Invalid full name. Please enter a valid name.";
    }
    $usernameCheckQuery = "SELECT username FROM users WHERE username = ?";
    $statement = $con->prepare($usernameCheckQuery);
    $statement->bind_param("s", $username);
    $statement->execute();
    $usernameCheckResult = $statement->get_result();
    if ($usernameCheckResult->num_rows > 0) {
        $errors['username'] = "Username already exists. Please choose a different username.";
    } 
    $emailCheckQuery = "SELECT email FROM users WHERE email = ?";
    $statement = $con->prepare($emailCheckQuery);
    $statement->bind_param("s", $email);
    $statement->execute();
    $emailCheckResult = $statement->get_result();
    if ($emailCheckResult->num_rows > 0) {
        $errors['email'] = "Email is already registered. Please use a different email address.";
    }  
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/", $raw_password)) {
        $errors['password'] = "Password should contain 8 characters whith at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }
    if (empty($address)) {
        $errors['address'] = "Address is required.";
    }
    if (!preg_match("/^[0-9]+$/", $phone_no)) {
        $errors['phone_no'] = "Invalid phone number. Please enter a valid number.";
    }
    if (empty($errors)) {
        $query = "INSERT INTO `users` (full_name, username, email, password, address,
       phone_no, account_id)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
       
        $statement = $con->prepare($query);
        $statement->bind_param("ssssssi", $full_name, $username, $email, $password,
       $address, $phone_no, $account_id);
        $result = $statement->execute();
    }
    if ($result) {
        echo "<div class='form'>
        <h3>You are registered successfully.</h3>";
    } else {
        echo "Registration failed.";
    }   
}
?>
<html>
<head>
 <meta charset="utf-8">
 <title>User Registration</title>
</head>
<body>
<div class="form">
 <h1>User Registration</h1>
 <form name="registration" action="" method="post">
 <table>
 <tr>
 <td><label for="full_name">Full Name:</label></td>
 <td><input type="text" name="full_name" id="full_name" placeholder="Full
Name" required>
<?php if(isset($errors['full_name'])) { echo "<p>" . $errors['full_name'] . "</p>"; } ?>

 </td>
 </tr>
 <tr>
 <td><label for="username">Username:</label></td>
 <td><input type="text" name="username" id="username"
placeholder="Username" required>
<?php if(isset($errors['username'])) { echo "<p>" . $errors['username'] . "</p>"; } ?>

 </td>
 </tr>
 <tr>
 <td><label for="email">Email:</label></td>
 <td><input type="email" name="email" id="email" placeholder="Email"
required>
<?php if(isset($errors['email'])) { echo "<p>" . $errors['email'] . "</p>"; } ?>

 </td>
 </tr>
 <tr>
 <td><label for="password">Password:</label></td>
 <td><input type="password" name="password" id="password" size="80"
placeholder="Password must be 8+ characters with uppercase, lowercase, number, and
special character." required>
<?php if(isset($errors['password'])) { echo "<p>" . $errors['password'] . "</p>"; } ?>

 </td>
 </tr>
 <tr>
 <td><label for="address">Address:</label></td>
 <td><input type="text" name="address" id="address" placeholder="Address"
required>
<?php if(isset($errors['address'])) { echo "<p>" . $errors['address'] . "</p>"; } ?>

 </td>
 </tr>
 <tr>
 <td><label for="phone_no">Phone Number:</label></td>
 <td><input type="text" name="phone_no" id="phone_no" placeholder="(Digits
only)" required>
<?php if(isset($errors['phone_no'])) { echo "<p>" . $errors['phone_no'] . "</p>"; } ?>

 </td>
 </tr>
 </table>
 <label>Account Type:</label>
 <input type="radio" name="account_id" value="1" checked> Lecturer
 <input type="radio" name="account_id" value="2"> Student
 <br>
 <input type="submit" name="submit" value="Register">
 </form>
 <br>
 <p><a href="user_login.php">Go to Login Page</a></p>
</div>
</body>
</html>
