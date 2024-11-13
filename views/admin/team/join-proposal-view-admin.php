<?php
require_once("../../../class/join_proposal.php");
require_once("../../paging.php");

$joinProposal = new JoinProposal();

$limit = 10;
$no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($no_hal - 1) * $limit;

$proposals = $joinProposal->getAllProposals($limit, $offset);
$total_proposals = $joinProposal->countAllProposals();

if (!$proposals) {
    die("Failed to load proposals data.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Proposals</title>
    <link rel="stylesheet" href="../../../public/css/style-admin.css">
</head>

<body>

    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <a href="dashboard.php"><img src="../../../public/images/logoubaya.png" alt="Logo"></a>
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
            <h1>All Join Proposals</h1>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Description</th>
                        <th>Team Name</th> 
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($proposals->num_rows > 0): ?>
                        <?php while ($row = $proposals->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['idmember']; ?></td>
                                <td><?php echo $row['fname']; ?></td>
                                <td><?php echo $row['lname']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['team_name']; ?></td> 
                                <td><?php echo $row['status']; ?></td> 
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No proposals available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php echo generate_page($total_proposals, $limit, '', $no_hal) . "<br>"; ?>
            </div>

            <a href="team-view.php" class="back-button">Back to Teams</a>
        </div>
    </div>

</body>

</html>
