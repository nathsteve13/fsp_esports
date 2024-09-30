<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/achievement.php");

$achievement = new Achievement();
$result = $achievement->getAchievements();
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
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['idachievement']; ?></td>
                    <td><?php echo $row['achievement_name']; ?></td>
                    <td><?php echo $row['team_name']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <a href="achievement-edit.php?id=<?php echo $row['idachievement']; ?>">Edit</a> |
                        <a href="achievement-delete.php?id=<?php echo $row['idachievement']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="achievement-add.php" >Add New Achievement</a>
    <a href="../../admin/dashboard.php">Back to home</a>
</body>

</html>
