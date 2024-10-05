<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team.php");

$team = new Team();

$now = strtotime("now");
$next = true;

if (isset($_SESSION['timestamp'])) {
    $diff = $now - $_SESSION['timestamp'];

    if ($diff < 60) {
        $next = false;
    } else {
        $_SESSION['timestamp'] = $now;
    }
} else {
    $_SESSION['timestamp'] = $now;
}
if ($next) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $idgame = $_POST['idgame'];

        $is_added = $team->addTeam($name, $idgame);

        if ($is_added) {
            header("Location: team-add.php?success=1");
            exit();
        } else {
            echo "Failed to add team.";
        }
    } else {
        header("Location: team-add.php");
        exit();
    }
} else {
    echo "Mohon tunggu " . (60 - $diff) . " sebelum mengirim kembali";
}
