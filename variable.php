<!DOCTYPE html>
<?php
$food = 'Tuna Pizza';
$price = 24.63;
$quantity = 5;
$isSpicy = true;

$subCode = 'UCCD3243';
$subName = 'UCCD3243 Server Side Web Applications Development';
$stuName = 'Tew Chia Li';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variable PHP Page</title>
</head>

<body>
    <div>
        <p>Subject Code: <?php echo $subCode ?></p>
        <p>Subject Name: <?php echo $subName ?></p>
        <p>Student Name: <?php echo $stuName ?></p>
    </div>
    <br>
    <div>
        <p>The selected food item is: <?php echo $food ?></p>
        <p>The price is: RM <?php echo $price ?></p>
        <p>Order qunatity is: <?php echo $quantity ?></p>
        <p>Do you want the food to be spicy: <?php echo $isSpicy ? "Yes" : "No" ?></p>
    </div>
</body>

</html>