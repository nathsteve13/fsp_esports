<?php
session_start();

if(!isset($_SESSION["username"])) {
    header("location: ../authentication/login.php");
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/class/member.php");

$member = new Member();
$current_user = $member->getMember($_SESSION["username"]);


require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/member.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/join_proposal.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/event.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/achievement.php");

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
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="../../public/images/logoubaya.png" alt="Logo">
            </div>
            <div class="user-info">
                <p>Welcome, <?php echo $current_user['username'] ?></p>
            </div>
            <ul class="nav-links">
                <li><a href="event/event-view.php">Events</a></li>
                <li><a href="game/game-view.php">Games</a></li>
                <li><a href="team/team-view.php">Teams</a></li>
                <li><a href="member/member-view.php">Members</a></li>
            </ul>
        </div>

        <div class="main-content">
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
