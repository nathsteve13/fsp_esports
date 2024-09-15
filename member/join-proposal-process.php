<?php
    $mysqli = new mysqli('localhost', 'root', '', 'esport');
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $idmember = $_POST['idmember'];  
    $idteam = $_POST['team'];       
    $description = $_POST['description'];  

    $status = 'waiting';

    $sql = "INSERT INTO join_proposal (idmember, idteam, description, status) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("iiss", $idmember, $idteam, $description, $status);
    if ($stmt->execute()) {
        header("Location: join-proposal.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
?>
