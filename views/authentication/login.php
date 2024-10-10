<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../public/css/style.css"> 
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <?php if (isset($_GET['error'])): ?>
        <div class="error-message">
            <p><?php echo htmlspecialchars($_GET['error']); ?></p>
        </div>
    <?php endif; ?>

    <form action="login-proses.php" method="POST" class="login-form">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <button type="submit" class="login-button">Login</button>
        </div>
    </form>

    <p class="register-link">Don't have an account? <a href="register.php">Register now!</a></p>
    <a href="../../index.php" class="back-button">Back</a>
</div>

</body>
</html>
