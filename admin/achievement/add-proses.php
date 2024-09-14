<?php
$mysqli= new mysqli('localhost','root','','esport');
if($mysqli->connect_error){
    die("Connection failed". $mysqli->connect_error);
}
$idteam = $_POST['idteam'];
$name = $_POST['name'];
$date = $_POST['date'];
$description = $_POST['description'];

$sql = "INSERT INTO achievement (idteam,name, date, description) VALUES ( ?,?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("isss",$idteam, $name, $date, $description);
$stmt->execute();

$stmt->close();
$mysqli->close();

header("Location: add-ach.php?hasil=1");
?>