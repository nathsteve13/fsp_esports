<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Game</title>
</head>
<body>
    <?php 
        $mysqli = new mysqli("localhost", "root", "", "esport");
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }
        
        $idgame = $_GET['idgame'];

        $sql = "SELECT * FROM game WHERE idgame = ?";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            die("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("i", $idgame);
        $stmt->execute();
        $res = $stmt->get_result();
        $game = $res->fetch_assoc();
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_POST['game-name'];
            $description = $_POST['description'];

            $sqlupdate = "update game set name = ?, description = ? where idgame = ?";
            $stmt = $mysqli->prepare($sqlupdate);
            $stmt->bind_param("ssi", $name, $description, $idgame);

            if ($stmt->execute()) {
                echo "Data updated!";
            } else {
                echo "Update failed : ".$stmt->error;
            }
        }

        $mysqli->close();
    ?>


    <form method="POST">
        <div class="game-form">
            <label>Game Name : </label>
            <input type="text" id="game-name" name="game-name"  value="<?php echo $game['name']; ?>" required>
        </div>
        
        <div class="game-form">
            <label>Description : </label>
            <input type="text" id="description" name="description" value="<?php echo $game['description']; ?>" required>
        </div>

        <div class="game-form">
            <input type="submit" value="Update Game">
        </div>

        <a href="game-read.php">Back to game view</a>
    </form>
</body>
</html>