<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team.php");

if (isset($_GET['idteam']) && isset($_GET['idevent'])) {
    $idteam = $_GET['idteam'];
    $idevent = $_GET['idevent'];

    $team = new Team();
    $team->removeEventFromTeam($idteam, $idevent);  

    header("Location: team-events-view.php?idteam=$idteam&delete_success=1");
    exit();
} else {
    die("Invalid request.");
}
?>
