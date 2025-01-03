<?php
require_once("../../class/game.php");
require_once("../../class/team.php");

$game = new Game();
$team = new Team();

if (isset($_GET['id'])) {
    $game_id = (int)$_GET['id'];
    $game_data = $game->getGameById($game_id);

    if (!$game_data) {
        echo "Game not found!";
        exit;
    }

    $teams = $team->getTeamsByGameId($game_id);

    $team_names = [];
    if ($teams && $teams->num_rows > 0) {
        while ($team_data = $teams->fetch_assoc()) {
            $team_names[] = htmlspecialchars($team_data['name']);
        }
    }
} else {
    echo "No game ID specified!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Detail</title>
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
            <h1>Game Detail</h1>
            <p><?php echo htmlspecialchars($game_data['name']); ?></p>
        </div>

        <main class="main">
            <div class="card">
                <h2>Game Information</h2>
                <p><strong>ID:</strong> <?php echo htmlspecialchars($game_data['idgame']); ?></p>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($game_data['name']); ?></p>
            </div>

            <div class="card">
                <h2>Teams Playing This Game</h2>
                <?php if (!empty($team_names)): ?>
                    <ul>
                        <?php foreach ($team_names as $team_name): ?>
                            <li><?php echo $team_name; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No teams are playing this game.</p>
                <?php endif; ?>
            </div>

            <a href="public-game-view.php" class="back-button">Back to Games List</a>
        </main>
    </div>
</body>

</html>
