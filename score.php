<!DOCTYPE html>
<html>

<head>
    <title>Student Grade</title>
</head>

<body>
    <div>
        <h1>Student Grade</h1>
        <?php
        $score = 75;

        echo "<p>Student's Score: " . $score . "</p>";
        echo "<p>Grade: ";

        switch (true) {
            case ($score >= 80):
                echo 'A';
                break;
            case ($score >= 70):
                echo 'B';
                break;
            case ($score >= 50):
                echo 'C';
                break;
            case ($score >= 40):
                echo 'D';
                break;
            default:
                echo 'F';
        }

        echo "</p>";
        ?>
    </div>
    <br>
    <div>
        <h1>Date Day</h1>
        <?php
        $date = 7;

        echo "<p>Date: " . $date . "</p>";
        echo "<p>Day: ";

        switch (true) {
            case ($date == 1):
                echo 'Monday';
                break;
            case ($date == 2):
                echo 'Tuesday';
                break;
            case ($date == 3):
                echo 'Wednesday';
                break;
            case ($date == 4):
                echo 'Thursday';
                break;
            case ($date == 5):
                echo 'Friday';
                break;
            case ($date == 6):
                echo 'Saturday';
                break;
            case ($date == 7):
                echo 'Sunday';
                break;
            default:
                echo 'NULL';
        }

        echo "</p>";
        ?>
    </div>
</body>

</html>