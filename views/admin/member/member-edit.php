<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/member.php");

$member = new Member();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $current_member = $member->getMemberById($id);
} else {
    header("Location: member-view.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $is_updated = $member->updateProfile($id);

    if ($is_updated) {
        header("Location: member-view.php?success=1");
        exit();
    } else {
        echo "Failed to update member profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member Profile</title>
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
            <div class="form-container">
                <h1>Edit Member Profile</h1>

                <p>Current Profile: <?php echo htmlspecialchars($current_member['profile']); ?></p>

                <form action="member-edit.php?id=<?php echo $id; ?>" method="POST">
                    <div class="form-group">
                        <label for="profile">Profile:</label>
                        <select name="profile" id="profile" disabled>
                            <option value="member" <?php if ($current_member['profile'] == 'member') echo 'selected'; ?>>Member</option>
                            <option value="admin" <?php if ($current_member['profile'] == 'admin') echo 'selected'; ?>>Admin</option>
                        </select>
                        <p><strong>Note:</strong> This action will update the profile to "Admin".</p>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-button">Update to Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>