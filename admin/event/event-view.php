<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Detail</title>
    <link rel="stylesheet" href="adminstyle.css">
</head>
<body>
    
    <?php 
        $mysqli = new mysqli("localhost", "root", "", "esport");
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }

        $sqlevent = "select * from event";
        $stmt = $mysqli->prepare($sqlevent);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows == 0) {
            echo "No events found!";
        } else {
            echo "<div class='card-grid'>";
            while ($row = $res->fetch_assoc()) {
                echo "<div class='card-card'>";
                echo "<div class='card-content'>";
                echo "<div class='card-name'>" . $row['name'] . "</div>";
                echo "<div class='card-meta'>Description: " . $row['description'] . "</div>";
                echo "</div>";
                echo "<div class='card-actions'>";
                echo "<a href='event-management-update-proses.php?idevent=" . $row['idevent'] . "'>Ubah Data</a>";
                echo "<a href='event-management-delete-proses.php?idevent=" . $row['idevent'] . "'>Hapus Data</a>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        }
    ?>
    <a href="event-management-insert.php" class="insert-button">New Event</a>
    <a href="../../index.php" class="insert-button">Back to home</a>
</body>
</html>