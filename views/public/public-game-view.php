<?php
require_once("../../class/game.php");
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
    <link rel="stylesheet" href="../../public/css/style-public.css">
</head>

<body>
    <div class="container">
        <header class="header">
            <div class="logo">
                <a href="../../index.php">
                    <img src="../../public/images/logoubaya.png" alt="Logo">
                </a>
            </div>
            <nav class="nav">
                <a href="../../index.php">Team</a>
                <a href="public-game-view.php">Game</a>
                <a href="../authentication/login.php">Login</a>
                <a href="../authentication/register.php">Register</a>
            </nav>
        </header>

        <div class="banner" style="background: url('../../public/images/banner.jpg') no-repeat center center/cover;">
            <h1>Games List</h1>
            <p>Explore our collection of exciting games!</p>
        </div>

        <main class="main">
            <div class="card-container">
                <?php if ($games->num_rows > 0): ?>
                    <?php while ($row = $games->fetch_assoc()): ?>
                        <div class="card">
                            <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                            <div class="card-actions">
                                <a href="public-game-detail.php?id=<?php echo $row['idgame']; ?>">View Details</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No games available</p>
                <?php endif; ?>
            </div>

            <div class="pagination">
                <?php
                $pagination = generate_page($total_games, $limit, '', $page);
                echo $pagination;
                ?>
            </div>
        </main>
    </div>
</body>

</html>
