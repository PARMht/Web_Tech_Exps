<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Expire the cookie by setting its time to the past
if (isset($_COOKIE['remember_name'])) {
    setcookie("remember_name", "", time() - 3600, "/");
}

// Redirect to login page
header("Location: login.php");
exit();
?>