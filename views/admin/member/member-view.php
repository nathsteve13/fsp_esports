<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/member.php");

$member = new Member();
$members = $member->getAllMembers();  // Tambahkan metode `getAllMembers` di class Member jika belum ada
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Members</title>
</head>
<body>

<h1>Members List</h1>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color:green;">Action completed successfully!</p>
<?php endif; ?>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Profile</th>
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
                    <td><?php echo $row['profile']; ?></td>
                    <td>
                        <a href="member-edit.php?id=<?php echo $row['idmember']; ?>">Edit</a> |
                        <a href="member-delete.php?id=<?php echo $row['idmember']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No members available</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<a href="member-add.php">Add New Member</a>

</body>
</html>
