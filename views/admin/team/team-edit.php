<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/game.php");

$team = new Team();
$game = new Game();
$games = $game->getGames();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $current_team = $team->getTeamById($id);
} else {
    header("Location: team-view.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $idgame = $_POST['idgame'];

    $is_updated = $team->editTeam($id, $name, $idgame);

    if ($is_updated) {
        header("Location: team-view.php?success=1");
        exit();
    } else {
        echo "Failed to update team.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team</title>
    <link rel="stylesheet" href="../../../public/css/style-admin.css"> 
</head>
<body>

<div class="dashboard-container">
    <div class="sidebar">
        <div class="logo">
            <a href="../dashboard.php"><img src="../../../public/images/logoubaya.png" alt="Logo"></a>
        </div>
        <ul class="nav-links">
            <li><a href="../event/event-view.php">Events</a></li>
            <li><a href="../game/game-view.php">Games</a></li>
            <li><a href="../team/team-view.php">Teams</a></li>
            <li><a href="../member/member-view.php">Members</a></li>
            <li><a href="../achievement/achievement-view.php">Achievement</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Edit Team</h1>

        <form action="team-edit.php?id=<?php echo $id; ?>" method="POST" class="form-container">
            <div class="form-group">
                <label for="name">Team Name:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($current_team['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="idgame">Game:</label>
                <select name="idgame" id="idgame" required>
                    <?php while ($row = $games->fetch_assoc()): ?>
                        <option value="<?php echo $row['idgame']; ?>" <?php if ($row['idgame'] == $current_team['idgame']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($row['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-button">Update Team</button>
            </div>
            <a href="team-view.php" class="back-button">Back to Teams</a>
        </form>
    </div>
</div>

</body>
</html>
