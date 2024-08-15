<?php
$con = mysqli_connect("localhost", "root", "", "dynamic_content");
 $sectionQuery = "SELECT about_us, contact_us FROM info";
 $sectionResult = mysqli_query($con, $sectionQuery);
 if ($sectionResult) {
 if (mysqli_num_rows($sectionResult) > 0) {
 while ($sectionRow = mysqli_fetch_assoc($sectionResult)) {echo "<h1> About Us: " . $sectionRow['about_us'] . "</h1>";
    echo "<p> Contact Us: " . $sectionRow['contact_us'] . "</p>";
    }
    } else {
    echo "No content found for Info";
    }
    } else {
    echo "Error in query for Info: " . mysqli_error($con);
    }
    mysqli_close($con);
   ?>