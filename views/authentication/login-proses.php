<?php
session_start();
require_once("../../class/member.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member = new Member();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $authenticated_member = $member->authenticate($username, $password);

    if ($authenticated_member) {
        $_SESSION['userid'] = $authenticated_member['idmember'];
        $_SESSION['username'] = $authenticated_member['username'];
        $_SESSION['role'] = $authenticated_member['profile']; 

        if ($_SESSION['role'] == 'admin') { 
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../member/home.php");
        }
        exit();
    } else {
        header("Location: login.php?error=" . urlencode("Incorrect Username or Password"));
        exit();
    }
}
?>
