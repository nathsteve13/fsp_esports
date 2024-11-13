<?php
require_once("../../../class/member.php");
require_once("../../paging.php");

$member = new Member();
$total_members = $member->getTotalMember();

$no_hal = (isset($_GET["page"])) ? $_GET["page"] : 1;
$LIMIT = 10;
$offset = ($no_hal - 1) * $LIMIT;

$members = $member->getAllMembers($offset, $LIMIT);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Members</title>
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
            <h1>Members List</h1>

            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <p style="color:green;">Action completed successfully!</p>
            <?php endif; ?>

            <table class="styled-table">
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

            <div class="pagination">
                <?php echo generate_page($total_members, $LIMIT, '', $no_hal) . "<br>"; ?>
            </div>
        </div>
    </div>

</body>

</html>