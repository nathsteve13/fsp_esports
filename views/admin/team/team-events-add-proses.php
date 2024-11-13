<?php
require_once("../../../class/event_teams.php");

$eventTeams = new EventTeams();

$idteam = $_POST['idteam'];
$idevent = $_POST['idevent'];

$eventTeams->addTeamToEvent($idevent, $idteam);

header("Location: ../team/team-events-view.php?idteam=$idteam&hasil=1");
exit();
?>
