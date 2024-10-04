<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/game.php");
require_once("../../paging.php");

$game = new Game();
$limit = 10; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$total_games = $game->countGame();
$games = $game->getGames($offset, $limit);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Games</title>
    <link rel="stylesheet" href="../../../public/css/style-admin.css">
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
        <h1>Games List</h1>

        <table class="styled-table">
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

        <div class="pagination">
            <?php
            $pagination = generate_page($total_games, $limit, '', $page);
            echo $pagination;
            ?>
        </div>

        <a href="game-add.php" class="add-button">Add New Game</a>
    </div>
</div>

</body>

</html>
