<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("location: ../authentication/login.php");
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/class/member.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team.php");
require_once("../paging.php");

$member = new Member();
if($_SESSION['role'] == 'admin'){
    header("location: ../admin/dashboard.php");
}
else{
    // header("location: ../member/hom.php");
}

$team = new Team();

$no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($no_hal - 1) * $limit;

$jumlahData = $team->countTeams();

$teams = $team->getTeams($offset, $limit);

$pagination = generate_page($jumlahData, $limit, '', $no_hal);

if (!$teams) {
    die("Failed to load teams data.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../../public/css/style-admin.css">
</head>
<body>
<div class="dashboard-container">
    <div class="sidebar">
        <div class="logo">
            <a href="../dashboard.php"><img src="../../../public/images/logoubaya.png" alt="Logo"></a>
        </div>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="join-proposal.php">join-proposal</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Teams List</h1>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Team Name</th>
                    <th>Game Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($teams->num_rows > 0): ?>
                    <?php while ($row = $teams->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['idteam']); ?></td>
                            <td><?php echo htmlspecialchars($row['team_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['game_name']); ?></td> 
                            <td>
                                <a href="join-proposal.php?idteam=<?php echo $row['idteam']; ?>">Join Proposal</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No teams available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>
</body>
</html>
