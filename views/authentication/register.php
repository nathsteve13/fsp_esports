<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<?php if (isset($_GET['error'])): ?>
    <div style="color:red;">
        <p><?php echo htmlspecialchars($_GET['error']); ?></p>
    </div>
<?php endif; ?>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div style="color:green;">
        <p>Registration successful! You can now <a href="login.php">login</a>.</p>
    </div>
<?php endif; ?>

<form action="register-proses.php" method="POST">
    <div>
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" required>
    </div>
    <div>
        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" required>
    </div>
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    
    <div>
        <button type="submit">Register</button>
    </div>
</form>

</body>
</html>
