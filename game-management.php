<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Management</title>
</head>
<body>
    <form action="game-management-process.php" method="POST" enctype="multipart/form-data">
        
        <div class="game-form">
            <label>Game Name : </label>
            <input type="text" id="game-name" name="game-name" required>
        </div>
        
        <div class="game-form">
            <label>Description : </label>
            <input type="text" id="description" name="description" required>
        </div>

        <div class="game-form">
            <input type="submit" value="Add Game">
        </div>
    </form>
</body>
</html>