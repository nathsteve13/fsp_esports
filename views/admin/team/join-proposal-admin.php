<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/join_proposal.php");

$joinProposal = new JoinProposal();

if (isset($_GET['idteam'])) {
    $idteam = $_GET['idteam'];
    $proposals = $joinProposal->getProposalsByTeam($idteam);
} else {
    header("Location: team-view.php");
    exit();
}

function redirect($idteam) {
    header("Location: join-proposal-admin.php?idteam=$idteam&success=1");
    exit();
}

if (isset($_GET['accept'])) {
    $idmember = $_GET['accept'];
    $joinProposal->acceptProposal($idteam, $idmember);
    redirect($idteam);
}

if (isset($_GET['reject'])) {
    $idmember = $_GET['reject'];
    $joinProposal->rejectProposal($idteam, $idmember);
    redirect($idteam);
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
            <img src="../../../public/images/logoubaya.png" alt="Logo">
        </div>
        <ul class="nav-links">
            <li><a href="../event/event-view.php">Events</a></li>
            <li><a href="../game/game-view.php">Games</a></li>
            <li><a href="../team/team-view.php">Teams</a></li>
            <li><a href="../member/member-view.php">Members</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Join Proposals for Team</h1>

        <?php if (isset($_GET['success'])): ?>
            <p style="color:green;">Operation successful!</p>
        <?php endif; ?>

        <!-- Table -->
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
                <?php if ($proposals->num_rows > 0): ?>
                    <?php while ($row = $proposals->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['idmember']; ?></td>
                            <td><?php echo $row['fname']; ?></td>
                            <td><?php echo $row['lname']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td>
                                <a href="join-proposal-admin.php?accept=<?php echo $row['idmember']; ?>&idteam=<?php echo $idteam; ?>" class="accept-button">Accept</a> |
                                <a href="join-proposal-admin.php?reject=<?php echo $row['idmember']; ?>&idteam=<?php echo $idteam; ?>" onclick="return confirm('Are you sure to reject?')" class="reject-button">Reject</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No proposals available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="team-view.php" class="back-button">Back to Teams</a>
    </div>
</div>

</body>

</html>
