<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Team</title>
</head>
<body>
    <?php 
        $mysqli = new mysqli("localhost", "root", "", "esport");
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }
        
        $idgame = $_GET['idteam'];

        $sql = "delete from team where idteam = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $idgame);

        if($stmt->execute()) {
            header("location: team-read.php");
        } else {
            echo "Delete failed : ".$stmt->error;
        }
    ?>
    

</body>
</html>