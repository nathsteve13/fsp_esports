<?php
require_once("../../../class/team.php");
require_once("../../paging.php");

$team = new Team();

$no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($no_hal - 1) * $limit;

$idteam = isset($_GET['idteam']) ? $_GET['idteam'] : null;

if (!$idteam) {
    die("Team ID is required.");
}

$jumlahData = $team->countAchievementsByTeam($idteam);
$achievements = $team->getAchievementsByTeam($idteam, $offset, $limit);
$pagination = generate_pageT($jumlahData, $limit, $idteam, $no_hal);

if (!$achievements) {
    die("Failed to load achievements data.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Team Achievements</title>
    <link rel="stylesheet" href="../../../public/css/style-admin.css">
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
            <h1>Achievements for Team ID: <?php echo htmlspecialchars($idteam); ?></h1>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Achievement Name</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($achievements->num_rows > 0): ?>
                        <?php while ($row = $achievements->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['idachievement']); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['date']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td>
                                    <a href="../achievement/achievement-edit.php?id=<?php echo htmlspecialchars($row['idachievement']); ?>" class="edit-button">Edit</a> |
                                    <a href="../achievement/achievement-delete.php?id=<?php echo htmlspecialchars($row['idachievement']); ?>" class="delete-button" onclick="return confirm('Are you sure?')">Delete</a> 
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No achievements available for this team.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php echo $pagination; ?>
            </div>
            <a href="../achievement/achievement-add.php?idteam=<?php echo $idteam; ?>" class="add-button">Add Achievement</a>
            <a href="team-view.php" class="back-button">Back to Teams</a>
        </div>
    </div>

</body>

</html>