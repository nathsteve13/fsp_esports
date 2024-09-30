<?php 

session_start();

if(!isset($_SESSION["username"])) {
    header("location: ../authentication/login.php");
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/class/member.php");

$member = new Member();
$current_user = $member->getMember($_SESSION["username"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard admin</title>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <p>Welcome, <?php echo htmlspecialchars($current_user['username']); ?>!</p>
</body>
</html>