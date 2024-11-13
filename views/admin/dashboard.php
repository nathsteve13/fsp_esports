<?php
session_start();

if(!isset($_SESSION["username"])) {
    header("location: ../authentication/login.php");
}

require_once("../../class/member.php");

$member = new Member();
if($_SESSION['role'] == 'admin'){
    
}
else{
    header("location: ../member/index.php");
}
$current_user = $member->getMember($_SESSION["username"]);


require_once("../../class/team.php");
require_once("../../class/member.php");
require_once("../../class/join_proposal.php");
require_once("../../class/event.php");
require_once("../../class/achievement.php");

$team = new Team();
$member = new Member();
$joinProposal = new JoinProposal();
$event = new Event();
$achievement = new Achievement();

$total_teams = $team->countTeams();
$total_members = $member->getTotalMember();
$total_join_proposals = $joinProposal->countJoinProposals();
$total_events = $event->countEvents();
$total_achievements = $achievement->countAchievements();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../public/css/dashboard-admin.css">
    </head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <a href="../dashboard.php"><img src="../../public/images/logoubaya.png" alt="Logo"></a>
            </div>
            <ul class="nav-links">
                <li><a href="event/event-view.php">Events</a></li>
                <li><a href="game/game-view.php">Games</a></li>
                <li><a href="team/team-view.php">Teams</a></li>
                <li><a href="member/member-view.php">Members</a></li>
                <li><a href="achievement/achievement-view.php">Achievement</a></li>
            </ul>
            <ul class="nav-links">
                <li><a href="../../logout.php" class="logout-button">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            
            <div class="user-info">
                <h2>Welcome, <?php echo htmlspecialchars($current_user['username']); ?>!</h2>
            </div>

            <div class="cards">
                <div class="card">
                    <h3>Total Teams</h3>
                    <p><?php echo $total_teams; ?></p>
                </div>
                <div class="card">
                    <h3>Total Members</h3>
                    <p><?php echo $total_members; ?></p>
                </div>
                <div class="card">
                    <h3>Total Join Proposals</h3>
                    <p><?php echo $total_join_proposals; ?></p>
                </div>
                <div class="card">
                    <h3>Total Events</h3>
                    <p><?php echo $total_events; ?></p>
                </div>
                <div class="card">
                    <h3>Total Achievements</h3>
                    <p><?php echo $total_achievements; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
