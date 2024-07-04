<!DOCTYPE html>
<html>

<head>
    <title>Odd or Even Number Checker</title>
</head>

<body>
    <div>
        <h1>Odd or Even Number Checker</h1>
        <?php
        $number1 = 35;

        echo "<p>Input Number: " . $number1 . "</p>";

        if ($number1 % 2 == 0) {
            echo "<p>" . $number1 . " is an even number.</p>";
        } else {
            echo "<p>" . $number1 . " is an odd number.</p>";
        }
        ?>
    </div>
    <br>
    <div>
        <h1>Positive, Negetive or Zero Number Checker</h1>
        <?php
        $number2 = 35;

        echo "<p>Input Number: " . $number2 . "</p>";

        if ($number2 > 0) {
            echo "<p>" . $number2 . " is a positive number.</p>";
        } elseif ($number2 < 0) {
            echo "<p>" . $number2 . " is a negetive number.</p>";
        } else {
            echo "<p>" . $number2 . " is a zero.</p>";
        }
        ?>
    </div>
</body>

</html>