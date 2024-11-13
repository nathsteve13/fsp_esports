<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("location: ../authentication/login.php");
}

require_once("../../class/member.php");
require_once("../../class/team.php");

$member = new Member();
$team = new Team();
$namaTeam = $team->getTeamById($_GET['idteam']);
$namaMember = $member->getMemberById($_SESSION['userid']);

$idmember = $_SESSION['userid'];
$idteam = isset($_GET['idteam']) ? $_GET['idteam'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Proposals</title>
    <link rel="stylesheet" href="../../public/css/style-admin.css">
</head>

<body>

    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <a href="home.php"><img src="../../public/images/logoubaya.png" alt="Logo"></a>
            </div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="my-team.php">My Team</a></li>
                <li><a href="join-proposal-view.php">Join Proposal</a></li>
            </ul>
            <ul class="nav-links">
                <li><a href="../../logout.php" class="logout-button">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <form action="join-proposal-member-proses.php?idteam=<?php echo htmlspecialchars($idteam); ?>" method="post">
                <?php if (isset($error_message)) { ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php } ?>
                <div class="form-group">
                    <label>Nama Team: </label>
                    <input type="text" name="namaTeam" value="<?php echo htmlspecialchars($namaTeam['name']); ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Nama Member :</label>
                    <input type="text" name="namaMember" value="<?php echo htmlspecialchars($namaMember['fname']); ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="New Proposal" class="submit-button">
                </div>
            </form>
            <a href="home.php" class="back-button">Back to Home</a>
        </div>
    </div>

</body>
</html>
