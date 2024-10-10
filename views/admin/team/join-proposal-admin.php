<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/join_proposal.php");
require_once("../../paging.php");

$joinProposal = new JoinProposal();

if (isset($_GET['idteam'])) {
    $idteam = $_GET['idteam'];
    $limit = 10;
    $no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($no_hal - 1) * $limit;

    $proposals = $joinProposal->getProposalsByTeam($idteam, $limit, $offset);
    $total_proposals = $joinProposal->countProposalsByTeam($idteam);
} else {
    header("Location: team-view.php");
    exit();
}

function redirect($idteam)
{
    header("Location: join-proposal-admin.php?idteam=$idteam&success=1");
    exit();
}

if (isset($_GET['accept'])) {
    $idmember = $_GET['accept'];
    if (!empty($idmember)) { // Pastikan $idmember tidak kosong
        $joinProposal->acceptProposal($idteam, $idmember);
        redirect($idteam);
    } else {
        echo "Invalid member ID.";
    }
}

if (isset($_GET['reject'])) {
    $idmember = $_GET['reject'];
    if (!empty($idmember)) { // Pastikan $idmember tidak kosong
        $joinProposal->rejectProposal($idteam, $idmember);
        redirect($idteam);
    } else {
        echo "Invalid member ID.";
    };
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
                        <th>Description</th>
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
                                <td><?php echo $row['description']; ?></td>
                                <td>
                                    <a href="join-proposal-admin.php?accept=<?php echo $row['idmember']; ?>&idteam=<?php echo $idteam; ?>" class="accept-button">Accept</a> |
                                    <a href="join-proposal-admin.php?reject=<?php echo $row['idmember']; ?>&idteam=<?php echo $idteam; ?>" onclick="return confirm('Are you sure to reject?')" class="reject-button">Reject</a>
                                </td>
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