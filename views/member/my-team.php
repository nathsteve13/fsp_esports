<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: ../authentication/login.php");
    exit();
}

require_once("../../class/join_proposal.php");
require_once("../../class/team_members.php");
require_once("../../class/achievement.php");
require_once("../../class/event_teams.php");
require_once("../paging.php");

$joinProposal = new JoinProposal();
$teamMembers = new TeamMembers();
$achievement = new Achievement();
$eventTeams = new EventTeams();

$idmember = $_SESSION['userid'];

// Pengaturan pagination
$no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5;
$offset = ($no_hal - 1) * $limit;

// Mendapatkan tim yang sudah disetujui untuk member ini
$jumlahData = $joinProposal->countProposalsByMember($idmember);
$teams = $joinProposal->getProposalsByMember($idmember, $limit, $offset);

$pagination = generate_page($jumlahData, $limit, '', $no_hal);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Team</title>
    <link rel="stylesheet" href="../../public/css/style-admin.css">
</head>

<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <a href="home.php"><img src="../../public/images/logoubaya.png" alt="Logo"></a>
            </div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="my-team.php">My Team</a></li>
                <li><a href="join-proposal-view.php">Join Proposal</a></li>
            </ul>
            <ul class="nav-links">
                <li><a href="../../logout.php" class="logout-button">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <h1>My Team</h1>

            <?php if ($teams->num_rows > 0): ?>
                <?php while ($team = $teams->fetch_assoc()): ?>
                    <?php if ($team['status'] == 'approved'): ?>
                        <div class="team-section">
                            <h2><?php echo htmlspecialchars($team['team_name']); ?></h2>

                            <!-- Daftar Anggota Tim -->
                            <h3>Members</h3>
                            <table class="styled-table">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $members = $teamMembers->getMembersByTeam($team['idteam']);
                                    if ($members->num_rows > 0):
                                        while ($member = $members->fetch_assoc()):
                                    ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($member['fname']); ?></td>
                                                <td><?php echo htmlspecialchars($member['lname']); ?></td>
                                            </tr>
                                        <?php
                                        endwhile;
                                    else:
                                        ?>
                                        <tr>
                                            <td colspan="2">No members found in this team.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <!-- Pencapaian Tim -->
                            <h3>Achievements</h3>
                            <table class="styled-table">
                                <thead>
                                    <tr>
                                        <th>Achievement Name</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $achievements = $achievement->getAchievementsByTeam($team['idteam']);
                                    if ($achievements->num_rows > 0):
                                        while ($ach = $achievements->fetch_assoc()):
                                    ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($ach['achievement_name']); ?></td>
                                                <td><?php echo htmlspecialchars($ach['date']); ?></td>
                                                <td><?php echo htmlspecialchars($ach['description']); ?></td>
                                            </tr>
                                        <?php
                                        endwhile;
                                    else:
                                        ?>
                                        <tr>
                                            <td colspan="3">No achievements found for this team.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <!-- Event Tim -->
                            <h3>Events</h3>
                            <table class="styled-table">
                                <thead>
                                    <tr>
                                        <th>Event Name</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $events = $eventTeams->getEventsByTeam($team['idteam']);
                                    if ($events->num_rows > 0):
                                        while ($event = $events->fetch_assoc()):
                                    ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($event['event_name']); ?></td>
                                                <td><?php echo htmlspecialchars($event['date']); ?></td>
                                                <td><?php echo htmlspecialchars($event['description']); ?></td>
                                            </tr>
                                        <?php
                                        endwhile;
                                    else:
                                        ?>
                                        <tr>
                                            <td colspan="3">No events found for this team.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <p>You are not part of any approved teams yet.</p>
            <?php endif; ?>

            <div class="pagination">
                <?php echo $pagination; ?>
            </div>
        </div>
    </div>
</body>

</html>