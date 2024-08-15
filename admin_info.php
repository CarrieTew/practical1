<!DOCTYPE html>
<html>
<head>
 <title>Admin Control Panel</title>
 <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

 <div class="container admin-panel">
 <h1 class="update-info-title">Update Info - Home Page</h1>
 <form action="update_info.php" method="post" class="info-form">
 <input type="hidden" name="new" value="1" />
 <label for="about_us" class="info-label">About Us</label>
 <input type="text" id="about_us" name="about_us" class="formcontrol"><br><br>
 <label for="contact_us" class="info-label">Contact Us</label>
 <textarea id="contact_us" name="contact_us" class="formcontrol"></textarea><br><br>
 <input type="submit" value="Update Info" class="btn-primary">
 </form>
 </div>
 <?php include 'footer.php'; ?>

</body>
</html>