<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/game.php");

$game = new Game();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $current_game = $game->getGameById($id);
} else {
    header("Location: game-view.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $is_updated = $game->editGame($id, $name, $description);

    if ($is_updated) {
        header("Location: game-view.php?success=1");
        exit();
    } else {
        echo "Failed to update game.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Game</title>
</head>
<body>

<h1>Edit Game</h1>

<form action="game-edit.php?id=<?php echo $id; ?>" method="POST">
    <div>
        <label for="name">Game Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $current_game['name']; ?>" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required><?php echo $current_game['description']; ?></textarea>
    </div>

    <div>
        <button type="submit">Update Game</button>
    </div>
</form>

</body>
</html>
