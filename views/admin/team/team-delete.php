<?php
require_once("../../../class/team.php");

$team = new Team();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $is_deleted = $team->deleteTeam($id);

    if ($is_deleted) {
        header("Location: team-view.php?success=1");
        exit();
    } else {
        echo "Failed to delete team.";
    }
}
?>
