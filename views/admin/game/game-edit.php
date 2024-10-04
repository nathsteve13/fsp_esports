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
    <link rel="stylesheet" href="../../../public/css/style-admin.css"> <!-- External CSS -->
</head>

<body>

<div class="dashboard-container">
    <div class="sidebar">
        <div class="logo">
            <img src="../../../public/images/logoubaya.png" alt="Logo">
        </div>
        <ul class="nav-links">
            <li><a href="../event/event-view.php">Events</a></li>
            <li><a href="../game/game-view.php">Games</a></li>
            <li><a href="../team/team-view.php">Teams</a></li>
            <li><a href="../member/member-view.php">Members</a></li>
            <li><a href="../achievement/achievement-view.php">Achievement</a></li>

        </ul>
    </div>

    <div class="main-content">
        <div class="form-container">
            <h1>Edit Game</h1>

            <form action="game-edit.php?id=<?php echo $id; ?>" method="POST">
                <div class="form-group">
                    <label for="name">Game Name:</label>
                    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($current_game['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" rows="4" required><?php echo htmlspecialchars($current_game['description']); ?></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-button">Update Game</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>
