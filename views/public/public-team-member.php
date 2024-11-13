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
        <h1>Team Members - <?php echo htmlspecialchars($team_name); ?></h1>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($members->num_rows > 0): ?>
                    <?php while ($row = $members->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['idmember']); ?></td>
                            <td><?php echo htmlspecialchars($row['fname']); ?></td>
                            <td><?php echo htmlspecialchars($row['lname']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No members in this team</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php echo generate_page($total_members, $limit, "", $no_hal); ?>
        </div>

        <a href="../../index.php" class="back-button">Back to Teams</a>
</body>
</html>