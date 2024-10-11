<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/achievement.php");

$achievement = new Achievement();

$idteam = isset($_GET['idteam']) ? $_GET['idteam'] : null;

if (!$idteam) {
    die("Team ID is required.");
}

$teams = $achievement->getTeams();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Achievement</title>
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
        <div class="form-container">
            <h1>Add New Achievement</h1>
            
            <?php if (isset($_GET['hasil']) && $_GET['hasil'] == 1): ?>
                <p style="color: blue;">Achievement added successfully!</p>
            <?php endif; ?>

            <form action="achievement-add-proses.php" method="POST">
                <input type="hidden" name="idteam" value="<?php echo htmlspecialchars($idteam); ?>">

                <div class="form-group">
                    <label for="idteam">Team Name:</label>
                    <select name="idteam" id="idteam" required disabled>
                        <option value="" disabled>Select a Team</option>
                        <?php
                        require_once($_SERVER['DOCUMENT_ROOT'] . "/class/achievement.php");
                        $achievement = new Achievement();
                        $teams = $achievement->getTeams();
                        $selected_team = isset($_GET['idteam']) ? $_GET['idteam'] : null;  

                        while ($row = $teams->fetch_assoc()) {
                            $selected = ($row['idteam'] == $selected_team) ? 'selected' : '';
                            echo "<option value='" . $row['idteam'] . "' $selected>" . htmlspecialchars($row['name']) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Achievement Name:</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" name="date" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" value="Add Achievement" class="submit-button">
                </div>
            </form>
            <a href="../team/team-achievement-view.php?idteam=<?php echo $idteam; ?> "class="back-button">View Achievements</a>
        </div>
    </div>
</div>

</body>

</html>
