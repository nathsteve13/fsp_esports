<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/game.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team.php");

$game = new Game();
$team = new Team();

if (isset($_GET['id'])) {
    $game_id = (int)$_GET['id'];
    $game_data = $game->getGameById($game_id);

    if (!$game_data) {
        echo "Game not found!";
        exit;
    }

    // Mendapatkan tim yang memainkan game ini menggunakan kelas Team
    $teams = $team->getTeamsByGameId($game_id);

    // Menggabungkan nama tim menjadi satu array
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
            <h1>Game Detail</h1>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Game Name</th>
                        <th>Teams</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($game_data['idgame']); ?></td>
                        <td><?php echo htmlspecialchars($game_data['name']); ?></td>
                        <td>
                            <?php if (!empty($team_names)): ?>
                                <ul>
                                    <?php foreach ($team_names as $team_name): ?>
                                        <li><?php echo $team_name; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>No teams are playing this game.</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <a href="public-game-view.php" class="back-button">Back to Games List</a>
        </div>
    </div>

</body>
</html>