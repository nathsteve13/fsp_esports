<?php 

require_once('Achievement.php');

$achievement = new Achievement();

$idteam = $_POST['idteam'];
$name = $_POST['name'];
$date = $_POST['date'];
$description = $_POST['description'];

$achievement->addAchievement($idteam, $name, $date, $description);

header("Location: achievement-view.php?hasil=1");

?>