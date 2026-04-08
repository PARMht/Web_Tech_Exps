<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve name from session or cookie
$userName = $_SESSION['user_name'];
$cookieMessage = "";

if (isset($_COOKIE['remember_name'])) {
    $cookieMessage = "Your username is currently being remembered by a cookie!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome - Protected Page</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .container { max-width: 600px; margin: auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px; text-align: center; }
        .btn-logout { display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 3px; }
        .btn-logout:hover { background-color: #c82333; }
        .cookie-alert { margin-top: 20px; font-size: 0.9em; color: #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($userName); ?>!</h1>
        <p>You have successfully logged in and accessed a session-protected page.</p>
        
        <?php if ($cookieMessage): ?>
            <p class="cookie-alert">🍪 <?php echo $cookieMessage; ?></p>
        <?php endif; ?>

        <a href="logout.php" class="btn-logout">Log Out</a>
    </div>
</body>
</html>