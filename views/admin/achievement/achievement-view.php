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
    <link rel="stylesheet" href="adminstyle.css">
</head>

<body>
    <h1 style="text-align: center;">Achievements</h1>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: center;">
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
                            <a href="achievement-edit.php?id=<?php echo htmlspecialchars($row['idachievement']); ?>">Edit</a> |
                            <a href="achievement-delete.php?id=<?php echo htmlspecialchars($row['idachievement']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
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

    <div style="text-align: center; margin-top: 20px;">
        <?php echo generate_page($totalData, $limit, '', $no_hal); ?>
    </div>

    <a href="achievement-add.php">Add New Achievement</a>
    <a href="../../admin/dashboard.php">Back to home</a>
</body>

</html>
