<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/event.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team.php");

$event = new Event();
$team = new Team();

$idteam = isset($_GET['idteam']) ? $_GET['idteam'] : null;

if (!$idteam) {
    die("Team ID is required.");
}

$events = $event->getAvailableEvents();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team to Event</title>
    <link rel="stylesheet" href="../../../public/css/style-admin.css"> 
</head>

<body>

<div class="dashboard-container">
    <div class="sidebar">
        <div class="logo">
            <img src="../../../public/images/logoubaya.png" alt="Logo">
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
            <h1>Add Team to Event</h1>
            
            <?php if (isset($_GET['hasil']) && $_GET['hasil'] == 1): ?>
                <p style="color: blue;">Team successfully added to event!</p>
            <?php endif; ?>

            <form action="team-events-add-proses.php" method="POST">
                <input type="hidden" name="idteam" value="<?php echo htmlspecialchars($idteam); ?>">

                <div class="form-group">
                    <label for="team_name">Team Name:</label>
                    <select name="idteam" id="idteam" required disabled>
                        <?php
                        $team_name = $team->getTeamById($idteam);
                        echo "<option value='" . $idteam . "' selected>" . htmlspecialchars($team_name['name']) . "</option>";
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="event">Select Event:</label>
                    <select name="idevent" id="idevent" required>
                        <option value="" disabled selected>Select an Event</option>
                        <?php
                        while ($row = $events->fetch_assoc()) {
                            echo "<option value='" . $row['idevent'] . "'>" . htmlspecialchars($row['name']) . " - " . htmlspecialchars($row['date']) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-button">Add Team to Event</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>
