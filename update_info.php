<?php
$con = mysqli_connect("localhost", "root", "", "dynamic_content");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
$aboutUs = $_REQUEST['about_us'];
$contactUs = $_REQUEST['contact_us'];
$last_updated = date("Y-m-d H:i:s");
$checkQuery = "SELECT id FROM info";
$checkResult = mysqli_query($con, $checkQuery);
if (mysqli_num_rows($checkResult) > 0) {
$updateQuery = "UPDATE info SET about_us='$aboutUs',
contact_us='$contactUs', last_updated='$last_updated'";
if (mysqli_query($con, $updateQuery)) {
$status = "Data has been updated Successfully.</br></br><a
href='index.php'>Go to About Us Page to view it</a>";
} else {
echo "Error: " . $updateQuery . "<br>" . mysqli_error($con);
}
} else {
$insertQuery = "INSERT INTO info (`about_us`, `contact_us`, `last_updated`)
VALUES ('$aboutUs', '$contactUs', '$last_updated')";
if (mysqli_query($con, $insertQuery)) {
$status = "Home Page info has been inserted Successfully.</br></br><a
href='index.php'>Go to About Us Page to view it</a>";
} else {
echo "Error: " . $insertQuery . "<br>" . mysqli_error($con);
}
}
mysqli_close($con);
}
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<title>Content-Presentation Separation</title>
</head>
<body>
<?php include 'header.php'; ?>

<div class="message-container">
<?php
if (isset($status)) {
echo $status;
}
?>
</div>
<?php include 'footer.php'; ?>
</body>
</html>