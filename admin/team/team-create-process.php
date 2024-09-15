<?php
    $mysqli= new mysqli('localhost','root','','esport');
    if($mysqli->connect_error){
        die("Connection failed". $mysqli->connect_error);
    }
    $idgame = $_POST['idgame'];
    $name = $_POST['team-name'];

    $sql = "INSERT INTO team (idgame, name) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("is",$idgame, $name);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();

    header("location: team-read.php");
?>