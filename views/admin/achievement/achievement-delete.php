<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/achievement.php");

$achievement = new Achievement();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $achievement->deleteAchievement($id);
    header("Location: ../team/team-view.php?hasil=1");
}
?>
