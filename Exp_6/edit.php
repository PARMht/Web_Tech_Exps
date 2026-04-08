<?php
include 'db.php';

// STEP 1: Fetch the existing user data to fill the form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit(); // Stop running if the user doesn't exist
    }
}

// STEP 2: Process the form when the user clicks 'Update'
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Update query - We only update name and email for simplicity, not the password
    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Show an alert, then redirect back to the dashboard
        echo "<script>
                alert('Record updated successfully!'); 
                window.location.href='dashboard.php';
              </script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Update User Details</h2>
    
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>
        
        <input type="submit" name="update" value="Update">
    </form>
    <br>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>