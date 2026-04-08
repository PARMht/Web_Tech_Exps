<?php
session_start();
require 'db.php'; // Using your existing DB connection

$error = '';

// If user is already logged in, redirect to welcome page
if (isset($_SESSION['user_id'])) {
    header("Location: welcome.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Fetch user by email
        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            // Verify the hashed password from Experiment 6
            if (password_verify($password, $row['password'])) {
                // Set Session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];

                // Set a cookie to remember the username for 24 hours
                setcookie("remember_name", $row['name'], time() + 86400, "/");

                header("Location: welcome.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No account found with that email.";
        }
        $stmt->close();
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Experiment 7</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="email"], input[type="password"] { width: 100%; padding: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #007BFF; color: white; border: none; border-radius: 3px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .error { color: red; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Login</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Log In</button>
        </form>
    </div>
</body>
</html>