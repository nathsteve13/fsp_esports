<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team.php");

$team = new Team();
$teams = $team->getTeams();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teams</title>
</head>
<body>

<h1>Teams List</h1>

<table border="1" cellpadding="10" cellspacing="0">
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
                    <td><?php echo $row['idteam']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['idgame']; ?></td>
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

<a href="team-add.php">Add New Team</a>

</body>
</html>
