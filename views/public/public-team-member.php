<?php 

require_once("../../class/team_members.php");
require_once("../../class/team.php"); 
require_once("../paging.php");

$teamMembers = new TeamMembers();
$team = new Team(); 

$limit = 10;
$no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($no_hal - 1) * $limit;

if (isset($_GET['id'])) {
    $idteam = $_GET['id'];
    $members = $teamMembers->getMembersByTeam($idteam); 
    $total_members = $members->num_rows; 
    
    $teamData = $team->getTeamById($idteam);
    $team_name = $teamData['name']; 
} else {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Member</title>
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
            <h1>Team Members - <?php echo htmlspecialchars($team_name); ?></h1>
            <p>Meet the members of this team!</p>
        </div>

        <main class="main">
            <div class="card-container">
                <?php if ($members->num_rows > 0): ?>
                    <?php while ($row = $members->fetch_assoc()): ?>
                        <div class="card">
                            <h2><?php echo htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></h2>
                            <p><strong>Username:</strong> <?php echo htmlspecialchars($row['username']); ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No members in this team</p>
                <?php endif; ?>
            </div>

            <div class="pagination">
                <?php echo generate_page($total_members, $limit, "", $no_hal); ?>
            </div>

            <a href="../../index.php" class="back-button">Back to Teams</a>
        </main>
</body>
</html>