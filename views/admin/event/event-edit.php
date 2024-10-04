<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/event.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/event_teams.php");

$event = new Event();
$team = new Team();
$eventTeams = new EventTeams();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $current_event = $event->getEventById($id);
    $current_teams = $eventTeams->getTeamsByEvent($id); 

    $participating_teams = [];
    while ($team_row = $current_teams->fetch_assoc()) {
        $participating_teams[] = $team_row['idteam'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $date = $_POST['date'];
        $description = $_POST['description'];
        $selected_teams = isset($_POST['teams']) ? $_POST['teams'] : []; 

        $is_updated = $event->editEvent($id, $name, $date, $description);

        if ($is_updated) {
            $eventTeams->deleteTeamsFromEvent($id); 

            foreach ($selected_teams as $team_id) {
                $eventTeams->addTeamToEvent($id, $team_id);
            }

            header("Location: event-view.php?success=1");
            exit();
        } else {
            echo "Failed to update event.";
        }
    }
}

$teams = $team->getAllTeams(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
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
            <li><a href="../achievement/achievement-view.php">Achievements</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="form-container">
            <h1>Edit Event</h1>

            <form action="event-edit.php?id=<?php echo $id; ?>" method="POST">
                <div class="form-group">
                    <label for="name">Event Name:</label>
                    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($current_event['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($current_event['date']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" rows="4" required><?php echo htmlspecialchars($current_event['description']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="teams">Select Teams Participating:</label><br>
                    <?php if ($teams->num_rows > 0): ?>
                        <?php while ($team_row = $teams->fetch_assoc()): ?>
                            <input type="checkbox" name="teams[]" value="<?php echo $team_row['idteam']; ?>" 
                                <?php echo in_array($team_row['idteam'], $participating_teams) ? 'checked' : ''; ?>>
                            <?php echo htmlspecialchars($team_row['name']); ?><br>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No teams available.</p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-button">Update Event</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>
