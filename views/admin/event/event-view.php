<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/event.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/event_teams.php");
require_once("../../paging.php");

$event = new Event();
$eventTeams = new EventTeams();

$total_events = $event->getTotalEvents();

$no_hal = (isset($_GET["page"])) ? $_GET["page"] : 1;
$LIMIT = 3;
$offset = ($no_hal - 1) * $LIMIT;

$events = $event->getEvents($offset, $LIMIT);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
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
        <h1>Events List</h1>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Teams Participating</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($events->num_rows > 0): ?>
                    <?php while ($row = $events->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['idevent']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td>
                                <?php
                                $teams = $eventTeams->getTeamsByEvent($row['idevent']);
                                if ($teams->num_rows > 0):
                                    echo "<ul>";
                                    while ($team = $teams->fetch_assoc()):
                                        echo "<li>" . $team['name'] . "</li>";
                                    endwhile;
                                    echo "</ul>";
                                else:
                                    echo "No teams registered";
                                endif;
                                ?>
                            </td>
                            <td>
                                <a href="event-edit.php?id=<?php echo $row['idevent']; ?>">Edit</a> |
                                <a href="event-delete.php?id=<?php echo $row['idevent']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No events available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php echo generate_page($total_events, $LIMIT, '', $no_hal) . "<br>"; ?>
        </div>

        <a href="event-add.php" class="add-button">Add New Event</a>
    </div>
</div>

</body>

</html>
