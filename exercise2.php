<?php
function customErrorHandler($errno, $errstr, $errfile, $errline){
    $error_message = "Error: [$errno] $errstr in $errfile on line $errline";

    error_log($error_message, 3, "error_log.txt");
    echo "OOps! Something went wrong. Please try again later.";

}

set_error_handler("customErrorHandler");

echo $undefinedVariable;
echo 100/0;
?>
