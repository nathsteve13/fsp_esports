<?php 

require_once("../../class/team.php");
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
    <link rel="stylesheet" href="../../public/css/style-public.css"> 
</head>
<body>
<div class="container">
        <header class="header">
            <div class="logo">
                <a href="../../index.php"><img src="../../public/images/logoubaya.png" alt="Logo"></a>
            </div>
            <nav class="nav">
                <a href="../../index.php">Team</a>
                <a href="public-game-view.php">Game</a>
                <a href="../authentication/login.php">Login</a>
                <a href="../authentication/register.php">Register</a>
            </nav>
        </header>

        <div class="banner" style="background: url('../../public/images/banner.jpg') no-repeat center center/cover;">
            <h1>Events for Team ID: <?php echo htmlspecialchars($idteam); ?></h1>
            <p>Explore upcoming and past events for this team!</p>
        </div>

        <main class="main">
            <div class="card-container">
                <?php if ($events->num_rows > 0): ?>
                    <?php while ($row = $events->fetch_assoc()): ?>
                        <div class="card">
                            <h2><?php echo htmlspecialchars($row['event_name']); ?></h2>
                            <p><strong>Date:</strong> <?php echo htmlspecialchars($row['date']); ?></p>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No events available for this team.</p>
                <?php endif; ?>
            </div>

            <div class="pagination">
                <?php echo $pagination; ?>
            </div>

            <a href="../../index.php" class="back-button">Back to Teams</a>
        </main>
</body>
</html>
