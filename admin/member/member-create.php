<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Management</title>
</head>
<body>
    <form action="member-create-process.php" method="POST" enctype="multipart/form-data">
        
        <div class="form">
            <label>First Name : </label>
            <input type="text" id="first-name" name="first-name" required>
        </div>
        
        <div class="form">
            <label>Last Name : </label>
            <input type="text" id="last-name" name="last-name" required>
        </div>

        <div class="form">
            <label>Username : </label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form">
            <label>Password : </label>
            <input type="text" id="password" name="password" required>
        </div>

        <div class="form">
            <input type="submit" value="Add Member">
        </div>
    </form>
</body>
</html>