<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="memberstyle.css">
</head>
<body>
    <div class="container">
        <h1>REGISTER</h1>
        <form action="register-proses.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>First Name : </label>
                <input type="text" id="first-name" name="first-name" required>
            </div>
            
            <div class="form-group">
                <label>Last Name : </label>
                <input type="text" id="last-name" name="last-name" required>
            </div>

            <div class="form-group">
                <label>Username : </label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label>Password : </label>
                <input type="text" id="password" name="password" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Add Member">
            </div>
        </form>
    </div>
</body>
</html>