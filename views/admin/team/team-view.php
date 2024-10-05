<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team.php");
require_once("../../paging.php");

$team = new Team();
$no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($no_hal - 1) * $limit;
$jumlahData = $team->countTeams();
$teams = $team->getTeams($offset, $limit);
$pagination = generate_page($jumlahData, $limit, '', $no_hal);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teams</title>
    <link rel="stylesheet" href="../../../public/css/style-admin.css"> <!-- External CSS -->
</head>

<body>

<div class="dashboard-container">
    <div class="sidebar">
        <div class="logo">
            <a href="../dashboard.php"><img src="../../../public/images/logoubaya.png" alt="Logo"></a>
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
        <h1>Teams List</h1>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Team Name</th>
                    <th>Game ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($teams->num_rows > 0): ?>
                    <?php while ($row = $teams->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['idteam']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['idgame']); ?></td>
                            <td>
                                <a href="team-edit.php?id=<?php echo $row['idteam']; ?>">Edit</a> |
                                <a href="team-delete.php?id=<?php echo $row['idteam']; ?>" onclick="return confirm('Are you sure?')">Delete</a> |
                                <a href="team-member-view.php?id=<?php echo $row['idteam']; ?>">View Members</a> |
                                <a href="join-proposal-admin.php?idteam=<?php echo $row['idteam']; ?>">Join Proposal</a>
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

        <a href="team-add.php" class="add-button">Add New Team</a>
    </div>
</div>

</body>

</html>
