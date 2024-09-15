<?php 
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if ($mysqli->connect_errno) {
        die("Failed to connect to MySQL: " . $mysqli->connect_error);
    }
    $idmember = $_GET['idmember'];
    $sql = "delete from member where idmember = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $idmember);
    if($stmt->execute()) {
        header("member-read.php");
    } else {
        echo "Delete failed : ".$stmt->error;
    }
?>