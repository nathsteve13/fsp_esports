<?php 

    $mysqli = new mysqli("localhost", "root", "", "esport");

    if ($mysqli->connect_errno) {
        die ("Failed to connect to MySQL: " . $mysqli->connect_error);
    }

    $game_name = $_POST['game-name'];
    $description = $_POST['description'];

    $sql = "insert into game (name, description) value (?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $game_name, $description);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();
    header("location: game-read.php");
?>
