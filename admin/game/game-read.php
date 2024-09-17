<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Detail</title>
    <link rel="stylesheet" href="adminstyle.css">
    
</head>
<body>
    
    <?php 
        $mysqli = new mysqli("localhost", "root", "", "esport");
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }

        $sqlgame = "select * from game";
        $stmt = $mysqli->prepare($sqlgame);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows == 0) {
            echo "No games found!";
        } else {
            echo "<div class='card-grid'>";
            while ($row = $res->fetch_assoc()) {
                echo "<div class='card-card'>";
                echo "<div class='card-content'>";
                echo "<div class='card-name'>" . $row['name'] . "</div>";
                echo "<div class='card-meta'>Description: " . $row['description'] . "</div>";
                echo "</div>";
                echo "<div class='card-actions'>";
                echo "<a href='game-update.php?idgame=" . $row['idgame'] . "'>Ubah Data</a>";
                echo "<a href='game-delete.php?idgame=" . $row['idgame'] . "'>Hapus Data</a>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        }
    ?>
    <a href="game-create.php" class="insert-button">New Game</a>
    <a href="../../index.php" class="insert-button">Back to view</a>

</body>
</html>