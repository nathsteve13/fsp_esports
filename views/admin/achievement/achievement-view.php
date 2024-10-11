<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/achievement.php");
require_once("../../paging.php");

$achievement = new Achievement();

$no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($no_hal - 1) * $limit;

$result = $achievement->getAchievements($offset, $limit);
$totalData = $achievement->countAchievements();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Achievements List</title>
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
            <h1>Achievements List</h1>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Achievement Name</th>
                        <th>Team Name</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0) { ?>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['idachievement']); ?></td>
                                <td><?php echo htmlspecialchars($row['achievement_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['team_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['date']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td>
                                    <a href="achievement-edit.php?id=<?php echo htmlspecialchars($row['idachievement']); ?>" class="edit-button">Edit</a> |
                                    <a href="achievement-delete.php?id=<?php echo htmlspecialchars($row['idachievement']); ?>" class="delete-button" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6">No achievements found.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php echo generate_page($totalData, $limit, '', $no_hal); ?>
            </div>
        </div>
    </div>

</body>

</html>