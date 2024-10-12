<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team.php");
require_once("../paging.php");
$team = new Team();

$no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($no_hal - 1) * $limit;

$idteam = isset($_GET['idteam']) ? $_GET['idteam'] : null;  

if (!$idteam) {
    die("Team ID is required.");
}

$jumlahData = $team->countEventsByTeam($idteam);  
$events = $team->getEventsByTeam($idteam, $offset, $limit);  
$pagination = generate_pageT($jumlahData, $limit, $idteam, $no_hal);

if (!$events) {
    die("Failed to load events data.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Event</title>
    <link rel="stylesheet" href="../../public/css/style-admin.css"> 
</head>
<body>
<div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <a href="index.php"><img src="../../public/images/logoubaya.png" alt="Logo"></a>
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
            <h1>Events for Team ID: <?php echo htmlspecialchars($idteam); ?></h1>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($events->num_rows > 0): ?>
                        <?php while ($row = $events->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['idevent']); ?></td>
                                <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['date']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No events available for this team.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>


            <div class="pagination">
                <?php echo $pagination; ?>
            </div>

            <a href="../../index.php" class="back-button">Back to Teams</a>
        </div>

        
</body>
</html>