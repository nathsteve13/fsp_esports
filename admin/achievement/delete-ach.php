<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM achievement WHERE idachievement = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("location: achievement-view.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$mysqli->close();
?>
