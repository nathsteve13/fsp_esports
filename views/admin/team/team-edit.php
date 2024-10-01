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
</head>
<body>

<h1>Edit Team</h1>

<form action="team-edit.php?id=<?php echo $id; ?>" method="POST">
    <div>
        <label for="name">Team Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $current_team['name']; ?>" required>
    </div>

    <div>
        <label for="idgame">Game:</label>
        <select name="idgame" id="idgame" required>
            <?php while ($row = $games->fetch_assoc()): ?>
                <option value="<?php echo $row['idgame']; ?>" <?php if ($row['idgame'] == $current_team['idgame']) echo 'selected'; ?>>
                    <?php echo $row['name']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div>
        <button type="submit">Update Team</button>
    </div>
</form>

</body>
</html>
