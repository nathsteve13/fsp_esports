<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Management</title>
    <link rel="stylesheet" href="adminstyle.css">
</head>
<body>
    <div class="container">
        <h1>Game</h1>
        <form action="game-create-process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Game Name : </label>
                <input type="text" id="game-name" name="game-name" required>
            </div>
            <div class="form-group">
                <label>Description : </label>
                <textarea type="text" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Add Game">
            </div>
        </form>
    </div>
</body>
</html>