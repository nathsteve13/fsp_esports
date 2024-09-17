<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Game</title>
</head>
<body>
    <?php 
        $mysqli = new mysqli("localhost", "root", "", "esport");
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }

        $idgame = $_GET['idgame'];

        $sql = "delete from game where idgame = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $idgame);

        if($stmt->execute()) {
            header("location: game-read.php");
        } else {
            echo "Delete failed : ".$stmt->error;
        }
    ?>
</body>
</html>