<?php
require('authentication.php');
if ($_SESSION['account_id'] !== 2 ) {
 header('Location: unauthorized.php');
 exit;
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
 <title>Student Dashboard</title>
</head>
<body>
 <h1>Welcome, <?php echo $username; ?>!</h1>
 <p>User dashboard for Student.</p>
 <a href="#">View Data</a><br><br>
 <a href="logout.php">Logout</a>
</body>
</html>