<?php 

    $mysqli = new mysqli("localhost", "root", "", "esport");

    if ($mysqli->connect_errno) {
        die ("Failed to connect to MySQL: " . $mysqli->connect_error);
    }

    $fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $profile = "member";

    $sql = "insert into member (fname,lname,username,password,profile) value (?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssss', $fname, $lname, $username, $password, $profile);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();
    header("location: member-read.php");
?>
