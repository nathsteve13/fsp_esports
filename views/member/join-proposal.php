<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/join_proposal.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/join_proposal.php");
require_once("../paging.php");

$joinProposal = new JoinProposal();

if (isset($_GET['idteam'])) {
    $idteam = $_GET['idteam'];
    $limit = 10;
    $no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($no_hal - 1) * $limit;
} else {
    header("Location: home.php");
    exit();
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
            <li><a href="home.php">Home</a></li>
            <li><a href="join-proposal.php">join-proposal</a></li>

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
                                <a href="join-proposal-admin.php?accept=<?php echo $row['idmember']; ?>&idteam=<?php echo $idteam; ?>" class="accept-button">Accept</a>
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

        <div class="pagination">
            <?php echo generate_page($total_proposals, $limit, '', $no_hal) . "<br>"; ?>
        </div>
    </div>
</div>

</body>

</html>