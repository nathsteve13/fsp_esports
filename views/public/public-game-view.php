<?php
require_once("class/game.php");
require_once("../paging.php");

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
                <a href="../../index.php"><img src="../../public/images/logoubaya.png" alt="Logo"></a>
            </div>

            <ul class="nav-links">
                <li><a href="../../index.php">Team</a></li>
                <li><a href="public-game-view.php">Game</a></li>
            </ul>

            <ul class="nav-links">
                <li><a href="../authentication/login.php">Login</a></li>
                <li><a href="../authentication/register.php">Register</a></li>
            </ul>
        </div>

        <div class="main-content">
            <h1>Games List</h1>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Game Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($games->num_rows > 0): ?>
                        <?php while ($row = $games->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['idgame']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>
                                    <a href="public-game-detail.php?id=<?php echo $row['idgame']; ?>">Detail</a>
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

        </div>
    </div>

</body>

</html>