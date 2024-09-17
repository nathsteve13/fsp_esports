<?php
$mysqli = new mysqli("localhost", "root", "", "esport");
if ($mysqli->connect_errno) {
    die ("Failed to connect to MySQL: " . $mysqli->connect_error);
}
    $name = $_POST['eventName'];
    $date = $_POST['eventDate']; $rilis=date("Y-m-d", strtotime($date));
    $description = $_POST['eventDescription'];

    $sql = "Insert into event (name, date, description)   VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sss', $name, $date, $description);
    $stmt->execute();

    $jumlah_yang_dieksekusi = $stmt->affected_rows;

    $stmt->close();
    $mysqli->close();
    header("location: event-view.php");
?>
