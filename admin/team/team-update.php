<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Team</title>
    <link rel="stylesheet" href="adminstyle.css">
</head>
<body>
    <?php 
        $mysqli = new mysqli("localhost", "root", "", "esport");
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }

        $idteam = $_GET['idteam'];

        $team_sql = "SELECT * FROM team WHERE idteam = ?";
        $team_stmt = $mysqli->prepare($team_sql);
        $team_stmt->bind_param('i', $idteam);
        $team_stmt->execute();
        $team_result = $team_stmt->get_result();
        $team = $team_result->fetch_assoc();

        $games_sql = "SELECT * FROM game";
        $games_result = $mysqli->query($games_sql);

        $members_sql = "SELECT * FROM member";
        $members_result = $mysqli->query($members_sql);

        $team_members_sql = "SELECT * FROM team_members WHERE idteam = ?";
        $team_members_stmt = $mysqli->prepare($team_members_sql);
        $team_members_stmt->bind_param('i', $idteam);
        $team_members_stmt->execute();
        $team_members_result = $team_members_stmt->get_result();
        $team_members = [];
        while ($row = $team_members_result->fetch_assoc()) {
            $team_members[] = $row['idmember'];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $team_name = $_POST['team_name'];
            $idgame = $_POST['idgame'];
            $team_members_new = $_POST['team_members'];

            $update_team_sql = "UPDATE team SET name = ?, idgame = ? WHERE idteam = ?";
            $update_team_stmt = $mysqli->prepare($update_team_sql);
            $update_team_stmt->bind_param('sii', $team_name, $idgame, $idteam);
            $update_team_stmt->execute();

            $delete_team_members_sql = "DELETE FROM team_members WHERE idteam = ?";
            $delete_team_members_stmt = $mysqli->prepare($delete_team_members_sql);
            $delete_team_members_stmt->bind_param('i', $idteam);
            $delete_team_members_stmt->execute();

            if (!empty($team_members_new)) {
                foreach ($team_members_new as $idmember) {
                    $insert_team_members_sql = "INSERT INTO team_members (idteam, idmember) VALUES (?, ?)";
                    $insert_team_members_stmt = $mysqli->prepare($insert_team_members_sql);
                    $insert_team_members_stmt->bind_param('ii', $idteam, $idmember);
                    $insert_team_members_stmt->execute();
                }
            }

            header("Location: team-read.php");
        }
    ?>

    <h1>Update Team</h1>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label for="team_name">Team Name:</label>
                <input type="text" name="team_name" id="team_name" value="<?php echo $team['name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="idgame">Game:</label>
                <select name="idgame" id="idgame" required>
                    <?php while ($game = $games_result->fetch_assoc()) { ?>
                        <option value="<?php echo $game['idgame']; ?>" <?php if ($team['idgame'] == $game['idgame']) echo 'selected'; ?>>
                            <?php echo $game['name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="team_members">Team Members:</label>
                <div>
                    <?php while ($member = $members_result->fetch_assoc()) { ?>
                        <input type="checkbox" name="team_members[]" value="<?php echo $member['idmember']; ?>" 
                            <?php if (in_array($member['idmember'], $team_members)) echo 'checked'; ?>>
                        <label><?php echo $member['fname'] . " " . $member['lname']; ?></label><br>
                    <?php } ?>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" value="Update Team">
            </div>

            <a href="team-read.php">Back to Team List</a>
        </form>
    </div>
</body>
</html>
