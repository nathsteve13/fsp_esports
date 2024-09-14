<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Event</title>
</head>
<body>
    <?php 
        $mysqli = new mysqli("localhost", "root", "", "esport");
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }

        $idevent = $_GET['idevent'];

        $sql = "delete from event where idevent = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $idevent);

        if($stmt->execute()) {
            echo "Event deleted!";
        } else {
            echo "Delete failed : ".$stmt->error;
        }
    ?>
</body>
</html>