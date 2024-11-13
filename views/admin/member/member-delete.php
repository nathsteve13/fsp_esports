<?php
require_once( "../../../class/member.php");

$member = new Member();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $is_deleted = $member->deleteMember($id);

    if ($is_deleted) {
        header("Location: member-view.php?success=1");
        exit();
    } else {
        echo "Failed to delete member.";
    }
} else {
    header("Location: member-view.php");
    exit();
}
?>
