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
    <link rel="stylesheet" href="public/css/style-admin.css">
</head>

<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <a href="index.php"><img src="public\images\logoubaya.png" alt="Logo"></a>
            </div>

            <ul class="nav-links">
                <li><a href="index.php">Team</a></li>
                <li><a href="views/public/public-game-view.php">Game</a></li>
            </ul>

            <ul class="nav-links">
                <li><a href="views/authentication/login.php">Login</a></li>
                <li><a href="views/authentication/register.php">Register</a></li>
            </ul>
        </div>

        <div class="main-content">

            <div class="user-info">
                <h2>UBAYA Informatics E-Sports</h2>
            </div>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Logo Team</th>
                        <th>Team Name</th>
                        <th>Game Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($teams->num_rows > 0): ?>
                        <?php while ($row = $teams->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['idteam']); ?></td>
                                <td>
                                    <?php
                                    $imagePath = "/public/images/teams/" . $row['idteam'] . ".jpg";

                                    if (file_exists(__DIR__ . '/' . $imagePath)): ?>
                                        <img src="<?php echo $imagePath; ?>" alt="Team Logo" width="50">
                                    <?php else: ?>
                                        No logo
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['team_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['game_name']); ?></td>
                                <td>
                                    <a href="/fsp_esports/views/public/public-team-member.php?id=<?php echo $row['idteam']; ?>">Members</a> |
                                    <a href="/fsp_esports/views/public/public-team-achievement.php?idteam=<?php echo $row['idteam']; ?>">Achievements</a> |
                                    <a href="/fsp_esports/views/public/public-team-event.php?idteam=<?php echo $row['idteam']; ?>">Events</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No teams available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php echo $pagination; ?>
            </div>

        </div>
    </div>
</body>

</html>