<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new team</title>
    <link rel="stylesheet" href="adminstyle.css">
</head>
<body>
    <div class="container">
        <h1>Create Team</h1>
    
        <form action="team-create-process.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Team Name : </label>
                <input type="text" id="team-name" name="team-name" required>
            </div>
            
            <div class="form-group">
                <label>Game : </label>
                <select name="idgame" id="idgame" required>
                    <option value="" disabled selected>Select a game</option>
                    <?php
                        $mysqli = new mysqli("localhost", "root", "", "esport");

                        if ($mysqli->connect_error) {
                            die("Connection failed: " . $stmt->connect_error);
                        }

                        $sql = "SELECT idgame, name FROM game";
                        $stmt = $mysqli->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['idgame'] . "'>" . $row['name'] . "</option>";
                        }
                        $mysqli->close();
                    ?>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" value="Add Team">
                <a href="../../index.php">Back to view</a>
            </div>
        </form>
        
    </div>
</body>
</html>