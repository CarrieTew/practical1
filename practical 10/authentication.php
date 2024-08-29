<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['account_id'])) {
 header('Location: unauthorized.php');
 exit;
}
?>