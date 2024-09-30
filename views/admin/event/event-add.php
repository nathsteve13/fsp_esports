<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
</head>
<body>

<h1>Add New Event</h1>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color:green;">Event added successfully!</p>
<?php endif; ?>

<form action="event-add-proses.php" method="POST">
    <div>
        <label for="name">Event Name:</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea>
    </div>

    <div>
        <button type="submit">Add Event</button>
    </div>
</form>

<a href="event-view.php">View Events</a>

</body>
</html>
