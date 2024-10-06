<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("location: ../authentication/login.php");
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/join_proposal.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/member.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team.php");
require_once("../paging.php");

$joinProposal = new JoinProposal();
$member = new Member();
$team = new Team();
$namaTeam = $team->getTeamById($_GET['idteam']);
$namaMember = $member-> getMemberById($_SESSION['userid']);
$idmember = $_SESSION['userid'];

if (isset($_GET['idteam'])) {
    $idteam = $_GET['idteam'];
    $limit = 10;
    $no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($no_hal - 1) * $limit;
} else {
    header("Location: home.php");
    exit();
}
$idteam = isset($_GET['idteam']) ? $_GET['idteam'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $joinProposal->addProposal($idteam,$idmember,$description);
    header("location: home.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Proposals</title>
    <link rel="stylesheet" href="../../../public/css/style-admin.css">
</head>

<body>

    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <img src="../../../public/images/logoubaya.png" alt="Logo">
            </div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="join-proposal.php">join-proposal</a></li>
            </ul>
        </div>

        <div class="main-content">
            <form action="" method="post">
                <div class="form-group">
                    <label>Nama Team: </label>
                    <input type="text" name="namaTeam" value="<?php echo $namaTeam['name']?>" disabled>
                </div>
                <div class="form-group">
                    <label>Nama Member :</label>
                    <input type="text" name="namaMember" value="<?php echo $namaMember['fname']?>" disabled>
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="AddProposal" class="submit-button">
                </div>
            </form>
        </div>
    </div>

</body>

</html>