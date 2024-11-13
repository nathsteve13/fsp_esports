<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: ../authentication/login.php");
    exit();
}

require_once("../../class/join_proposal.php");
require_once("../paging.php");

$joinProposal = new JoinProposal();

if ($_SESSION['role'] == 'admin') {
    header("location: ../admin/dashboard.php");
    exit();
}

$idmember = $_SESSION['userid']; 

$no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($no_hal - 1) * $limit;

$jumlahData = $joinProposal->countProposalsByMember($idmember);  
$proposals = $joinProposal->getProposalsByMember($idmember, $limit, $offset); 

$pagination = generate_page($jumlahData, $limit, '', $no_hal);

if (!$proposals) {
    die("Failed to load proposals data.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Join Proposals</title>
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
        <h1>My Join Proposals</h1>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Team Name</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($proposals->num_rows > 0): ?>
                    <?php while ($row = $proposals->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['team_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td> 
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">You have not submitted any join proposals.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>
</body>

</html>
