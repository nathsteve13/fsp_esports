<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("location: ../authentication/login.php");
}

require_once("../../class/member.php");
require_once("../../class/team.php");
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
$filter = isset($_GET['cari']) ? $_GET['cari'] : '';
$jumlahData = $team->countTeams($filter);

$teams = $team->getTeams($offset, $limit,$filter);

$pagination = generate_page($jumlahData, $limit, $filter, $no_hal);

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
    <link rel="stylesheet" href="../../public/css/style-admin.css">
</head>
<body>
<div class="dashboard-container">
    <div class="sidebar">
        <div class="logo">
            <a href=""><img src="../../public/images/logoubaya.png" alt="Logo"></a>
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
        <h1>Teams List</h1>
        <form method="GET" action="home.php">
            <input type="text" name="cari" placeholder="Search teams" value="<?php echo htmlspecialchars($filter); ?>">
            <button type="submit">Search</button>
        </form>
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
                                <a href="join-proposal.php?idteam=<?php echo $row['idteam']; ?>">Join Proposal</a> |
                                <a href="member-achievement-view.php?idteam=<?php echo $row['idteam']; ?>">Achievement</a> |
                                <a href="member-event-view.php?idteam=<?php echo $row['idteam']; ?>">Event</a>
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

        <div class="pagination">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>
</body>
</html>
