<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("location: ../authentication/login.php");
    exit();
}

require_once("class/member.php");

$member = new Member();
if($_SESSION['role'] == 'member'){
    header("location: ../member/home.php");
    exit();
}
else{
    header("location: ../admin/dashboard.php");
    exit();
}
?>