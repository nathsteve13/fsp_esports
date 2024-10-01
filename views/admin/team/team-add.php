<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/game.php");

$game = new Game();
$games = $game->getGames();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team</title>
</head>
<body>

<h1>Add New Team</h1>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color:green;">Team added successfully!</p>
<?php endif; ?>

<form action="team-add-proses.php" method="POST">
    <div>
        <label for="name">Team Name:</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div>
        <label for="idgame">Game:</label>
        <select name="idgame" id="idgame" required>
            <option value="">Select a game</option>
            <?php while ($row = $games->fetch_assoc()): ?>
                <option value="<?php echo $row['idgame']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <div>
        <button type="submit">Add Team</button>
    </div>
</form>

<a href="team-view.php">View Teams</a>

</body>
</html>
