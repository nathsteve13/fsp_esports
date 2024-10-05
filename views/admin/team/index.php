<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("location: ../authentication/login.php");
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/class/member.php");

$member = new Member();
if($_SESSION['role'] == 'admin'){
    header("location: team-view.php");
}
else{
    header("location: ../member/index.php");
}
?>