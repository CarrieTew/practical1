<?php
require('authentication.php');
if ($_SESSION['account_id'] !== 1) {
 header('Location: unauthorized.php');
 exit;
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
 <title>Lecturer Dashboard</title>
</head>
<body>
 <h1>Welcome, <?php echo $username; ?>!</h1>
 <p>User dashboard for Lecturer.</p>
 <a href="#">Insert Data</a><br>
 <a href="logout.php">Logout</a>
</body>
</html>