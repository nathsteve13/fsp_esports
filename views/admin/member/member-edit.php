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
</head>
<body>

<h1>Edit Member Profile</h1>

<p>Current Profile: <?php echo $current_member['profile']; ?></p>

<form action="member-edit.php?id=<?php echo $id; ?>" method="POST">
    <div>
        <label for="profile">Profile:</label>
        <select name="profile" id="profile" disabled>
            <option value="member" <?php if ($current_member['profile'] == 'member') echo 'selected'; ?>>Member</option>
            <option value="admin" <?php if ($current_member['profile'] == 'admin') echo 'selected'; ?>>Admin</option>
        </select>
        <p><strong>Note:</strong> This action will update the profile to "Admin".</p>
    </div>

    <div>
        <button type="submit">Update to Admin</button>
    </div>
</form>

</body>
</html>
