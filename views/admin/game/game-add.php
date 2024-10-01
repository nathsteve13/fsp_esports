<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Game</title>
</head>
<body>

<h1>Add New Game</h1>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color:green;">Game added successfully!</p>
<?php endif; ?>

<form action="game-add-proses.php" method="POST">
    <div>
        <label for="name">Game Name:</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea>
    </div>

    <div>
        <button type="submit">Add Game</button>
    </div>
</form>

<a href="game-view.php">View Games</a>

</body>
</html>
