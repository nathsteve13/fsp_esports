<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team_members.php");

$teamMembers = new TeamMembers();

if (isset($_GET['idmember']) && isset($_GET['idteam'])) {
    $idteam = $_GET['idteam'];
    $idmember = $_GET['idmember'];

    if ($teamMembers->deleteMemberFromTeam($idteam, $idmember)) {
        echo "<p style='color: green;'>Member has been successfully removed from the team.</p>";
    } else {
        echo "<p style='color: red;'>Failed to remove member from the team.</p>";
    }
}

if (isset($_GET['id'])) {
    $idteam = $_GET['id'];
    $members = $teamMembers->getMembersByTeam($idteam);
} else {
    header("Location: team-view.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Team Members</title>
</head>
<body>

<h1>Team Members</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Member ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($members->num_rows > 0): ?>
            <?php while ($row = $members->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['idmember']; ?></td>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td>
                        <a href="team-member-view.php?id=<?php echo $idteam; ?>&idmember=<?php echo $row['idmember']; ?>&idteam=<?php echo $idteam; ?>" onclick="return confirm('Are you sure you want to remove this member from the team?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No members in this team</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<a href="team-view.php">Back to Teams</a>

</body>
</html>
