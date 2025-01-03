<?php
require_once("class/team.php");

require_once("views/paging.php");

$team = new Team();

$no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($no_hal - 1) * $limit;

$jumlahData = $team->countTeams();

$teams = $team->getTeams($offset, $limit);

$pagination = generate_page($jumlahData, $limit, '', $no_hal);

if (!$teams) {
    die("Failed to load teams data.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="public/css/style-public.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo">
                <a href="index.php">
                    <img src="public/images/logoubaya.png" alt="Logo">
                </a>
            </div>
            <nav class="nav">
                <a href="index.php">Team</a>
                <a href="views/public/public-game-view.php">Game</a>
                <a href="views/authentication/login.php">Login</a>
                <a href="views/authentication/register.php">Register</a>
            </nav>
        </header>

        <div class="banner" style="background: url('public/images/banner.jpg') no-repeat center center/cover;">
            <h1>Welcome to UBAYA E-Sports</h1> <br>
            <p>The team of champions is here!</p>
        </div>

        <main class="main">
            <h2>Our Teams</h2>
            <div class="card-container">
                <?php if ($teams->num_rows > 0): ?>
                    <?php while ($row = $teams->fetch_assoc()): ?>
                        <div class="card">
                            <h2><?php echo htmlspecialchars($row['team_name']); ?></h2>
                            <p>Game: <?php echo htmlspecialchars($row['game_name']); ?></p>
                            <div class="card-actions">
                                <a href="views/public/public-team-member.php?id=<?php echo $row['idteam']; ?>">Members</a> 
                                <a href="views/public/public-team-achievement.php?idteam=<?php echo $row['idteam']; ?>">Achievements</a> 
                                <a href="views/public/public-team-event.php?idteam=<?php echo $row['idteam']; ?>">Events</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No teams available</p>
                <?php endif; ?>
            </div>

            <div class="pagination">
                <?php echo $pagination; ?>
            </div>
        </main>
    </div>
</body>
</html>
