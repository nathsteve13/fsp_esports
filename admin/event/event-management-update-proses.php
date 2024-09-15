<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
</head>
<body>
    <?php 
        $mysqli = new mysqli("localhost", "root", "", "esport");
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }
        
        $idevent = $_GET['idevent'];

        $sql = "select * from event WHERE idevent = ?";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            die("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("i", $idevent);
        $stmt->execute();
        $res = $stmt->get_result();
        $event = $res->fetch_assoc();
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $event = $_POST['eventName'];
            $date = $_POST['eventDate']; $rilis=date("Y-m-d", strtotime($date));
            $description = $_POST['eventDescription'];

            $sqlupdate = "update event set name = ?, date = ?, description = ?, where idevent = ?";
            $stmt = $mysqli->prepare($sqlupdate);
            $stmt->bind_param("sssi", $name, $date, $description, $idevent);

            if ($stmt->execute()) {
                echo "Data updated!";
            } else {
                echo "Update failed : ".$stmt->error;
            }
        }

        $mysqli->close();
    ?>


    <form method="POST">
        <div class="event-form">
            <label>Name Event : </label>
            <input type="text" id="eventName" name="eventName"  value="<?php echo $event['name']; ?>" required>
        </div>
        
        <div class="event-form">
            <label>Date Event : </label>
            <input type="date" id="eventDate" name="eventDate"  value="<?php echo $event['date']; ?>" required>
        </div>

        <div class="event-form">
            <label>Description Event : </label>
            <input type="text" id="eventDescription" name="eventDescription" value="<?php echo $event['description']; ?>" required>
        </div>

        <div class="event-form">
            <input type="submit" value="Update Event">
        </div>

        <a href="event-view.php">Back to Event view</a>
    </form>
</body>
</html>
