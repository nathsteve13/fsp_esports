<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("location: ../authentication/login.php");
}

require_once("class/join_proposal.php");
require_once("class/member.php");
require_once("class/team.php");

$joinProposal = new JoinProposal();
$member = new Member();
$team = new Team();

$namaTeam = $team->getTeamById($_GET['idteam']);
$namaMember = $member->getMemberById($_SESSION['userid']);
$idmember = $_SESSION['userid'];

if (isset($_GET['idteam'])) {
    $idteam = $_GET['idteam'];
} else {
    header("Location: home.php");
    exit();
}

$idteam = isset($_GET['idteam']) ? $_GET['idteam'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];

    if (isset($_SESSION['proposal_time'][$idmember][$idteam])) {
        $last_proposal_time = $_SESSION['proposal_time'][$idmember][$idteam];
        $current_time = time();

        if (($current_time - $last_proposal_time) < 21600) { 
            $remaining_time = 21600 - ($current_time - $last_proposal_time);
            $hours = floor($remaining_time / 3600); 
            $minutes = floor(($remaining_time % 3600) / 60); 
    
            $error_message = "Anda harus menunggu " . $hours . " jam " . $minutes . " menit lagi sebelum mengajukan proposal baru.";
        } else {
            $_SESSION['proposal_time'][$idmember][$idteam] = $current_time;
            $joinProposal->addProposal($idteam, $idmember, $description);
            header("location: home.php");
            exit();
        }
    } else {
        $_SESSION['proposal_time'][$idmember][$idteam] = time();
        $joinProposal->addProposal($idteam, $idmember, $description);
        header("location: home.php");
        exit();
    }
}
?>
