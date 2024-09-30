<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/event.php");

$event = new Event();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $current_event = $event->getEventById($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        $is_updated = $event->editEvent($id, $name, $date, $description);

        if ($is_updated) {
            header("Location: event-view.php?success=1");
            exit();
        } else {
            echo "Failed to update event.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
</head>
<body>

<h1>Edit Event</h1>

<form action="event-edit.php?id=<?php echo $id; ?>" method="POST">
    <div>
        <label for="name">Event Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $current_event['name']; ?>" required>
    </div>

    <div>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" value="<?php echo $current_event['date']; ?>" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required><?php echo $current_event['description']; ?></textarea>
    </div>

    <div>
        <button type="submit">Update Event</button>
    </div>
</form>

</body>
</html>
