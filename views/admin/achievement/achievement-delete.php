<?php
require_once('Achievement.php');

$achievement = new Achievement();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $achievement->deleteAchievement($id);
    header("Location: achievement-view.php?hasil=3");
}
?>
