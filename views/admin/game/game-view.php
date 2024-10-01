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
    <title>View Games</title>
</head>
<body>

<h1>Games List</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Game Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($games->num_rows > 0): ?>
            <?php while ($row = $games->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['idgame']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <a href="game-edit.php?id=<?php echo $row['idgame']; ?>">Edit</a> |
                        <a href="game-delete.php?id=<?php echo $row['idgame']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No games available</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<a href="game-add.php">Add New Game</a>

</body>
</html>
