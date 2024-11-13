<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("location: ../authentication/login.php");
}

require_once("../../../class/member.php");

$member = new Member();
if($_SESSION['role'] == 'admin'){
    header("location: event-view.php");
}
else{
    header("location: ../member/index.php");
}
?>