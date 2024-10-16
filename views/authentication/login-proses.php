<?php
session_start();
require_once("../../class/member.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $now = strtotime("now");

    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }
    if (isset($_SESSION['last_login_attempt'])) {
        $diff = $now - $_SESSION['last_login_attempt'];

        if ($diff < 60 && $_SESSION['login_attempts'] >= 3) {
            $wait_time = 60 - $diff;
            header("Location: login.php?error=" . urlencode("Terlalu banyak percobaan login. Mohon tunggu " . $wait_time . " detik."));
            exit();
        } elseif ($diff >= 60) {
            $_SESSION['login_attempts'] = 0;
        }
    }

    $_SESSION['last_login_attempt'] = $now;

    $member = new Member();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $authenticated_member = $member->authenticate($username, $password);

    if ($authenticated_member) {
        $_SESSION['userid'] = $authenticated_member['idmember'];
        $_SESSION['username'] = $authenticated_member['username'];
        $_SESSION['role'] = $authenticated_member['profile'];
        
        unset($_SESSION['login_attempts']);
        unset($_SESSION['last_login_attempt']);

        if ($_SESSION['role'] == 'admin') { 
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../member/home.php");
        }
        exit();
    } else {
        $_SESSION['login_attempts'] += 1;
        $_SESSION['last_login_attempt'] = $now;

        if ($_SESSION['login_attempts'] >= 3) {
            header("Location: login.php?error=" . urlencode("3 kali percobaan gagal. Mohon tunggu 60 detik sebelum mencoba lagi."));
        } else {
            header("Location: login.php?error=" . urlencode("Username atau Password salah. Percobaan ke-" . $_SESSION['login_attempts']));
        }
        exit();
    }
}
?>
