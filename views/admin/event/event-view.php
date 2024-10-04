<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/event.php");
require_once("../../paging.php");

$event = new Event();
$total_events = $event->getTotalEvents();

$no_hal = (isset($_GET["page"])) ? $_GET["page"] : 1;
$LIMIT = 3;
$offset = ($no_hal-1) * $LIMIT;

$events = $event->getEvents($offset, $LIMIT);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
</head>
<body>

<h1>Events List</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Event Name</th>
            <th>Date</th>
            <th>Description</th>
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
                        <a href="event-edit.php?id=<?php echo $row['idevent']; ?>">Edit</a> |
                        <a href="event-delete.php?id=<?php echo $row['idevent']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No events available</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php echo generate_page($total_events, $LIMIT, '', $no_hal)."<br>"; ?>

<a href="event-add.php">Add New Event</a>

</body>
</html>
