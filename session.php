<?php
// Start session
session_start();

// Check whether the session variable 'id' is present and not equal to 0
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header("location: index.php");
    exit();
}

$session_id = $_SESSION['id'];
?>