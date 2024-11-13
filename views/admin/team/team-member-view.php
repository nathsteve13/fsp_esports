<?php
require_once( "../../../class/team_members.php");
require_once( "../../../class/team.php"); 
require_once("../../paging.php");

$teamMembers = new TeamMembers();
$team = new Team(); 

$limit = 10;
$no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($no_hal - 1) * $limit;

if (isset($_GET['idmember']) && isset($_GET['idteam'])) {
    $idteam = $_GET['idteam'];
    $idmember = $_GET['idmember'];

    if ($teamMembers->deleteMemberFromTeam($idteam, $idmember)) {
        echo "<p style='color: green;'>Member has been successfully removed from the team.</p>";
    } else {
        echo "<p style='color: red;'>Failed to remove member from the team.</p>";
    }
}

if (isset($_GET['id'])) {
    $idteam = $_GET['id'];
    $members = $teamMembers->getMembersByTeam($idteam); 
    $total_members = $members->num_rows; 
    
    $teamData = $team->getTeamById($idteam);
    $team_name = $teamData['name']; 
} else {
    header("Location: team-view.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Team Members - <?php echo htmlspecialchars($team_name); ?></title>
    <link rel="stylesheet" href="../../../public/css/style-admin.css"> 
</head>
<body>

<div class="dashboard-container">
    <div class="sidebar">
        <div class="logo">
            <a href="../dashboard.php"><img src="../../../public/images/logoubaya.png" alt="Logo"></a>
        </div>
        <ul class="nav-links">
            <li><a href="../event/event-view.php">Events</a></li>
            <li><a href="../game/game-view.php">Games</a></li>
            <li><a href="../team/team-view.php">Teams</a></li>
            <li><a href="../member/member-view.php">Members</a></li>
            <li><a href="../achievement/achievement-view.php">Achievement</a></li>
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
                    <th>Actions</th>
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
                            <td>
                                <a href="team-member-view.php?id=<?php echo $idteam; ?>&idmember=<?php echo $row['idmember']; ?>&idteam=<?php echo $idteam; ?>" onclick="return confirm('Are you sure you want to remove this member from the team?')">Delete</a>
                            </td>
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

        <a href="team-view.php" class="back-button">Back to Teams</a>
    </div>
</div>

</body>
</html>
