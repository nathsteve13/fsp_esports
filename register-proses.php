<?php
    $mysqli= new mysqli('localhost','root','','esport');
    if($mysqli->connect_error){
        die("Connection failed". $mysqli->connect_error);
    }
    $fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $profile = "member";

    $sql = "INSERT INTO member (fname, lname, username, password, profile) VALUES (?, ?, ?, ? ,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssss",$fname, $lname, $username, $password, $profile);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();

    header("location: index.php");
?>