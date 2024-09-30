<?php
require_once("../../class/member.php");

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        $member = new Member();
        $is_registered = $member->addMember($fname, $lname, $username, $password);

        if ($is_registered) {
            header("Location: register.php?success=1");
        } else {
            header("Location: register.php?error=" . urlencode("Failed to register the user. Please try again."));
        }
    } else {
        $error_message = implode(" ", $errors);
        header("Location: register.php?error=" . urlencode($error_message));
    }
}
?>
