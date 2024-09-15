<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Proposal</title>
</head>
<body>
    <?php 
        $mysqli = new mysqli("localhost", "root", "", "esport");
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }

        $sql = "SELECT idteam, name FROM team";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows == 0) {
            echo "No Teams Available!";
        } else {
            echo '<form action="join-proposal-process.php" method="POST" enctype="multipart/form-data">';

            echo '<div class="form">';
            echo '<label for="team">Select Team:</label>';
            echo '<select id="team" name="team" required>';
            
            while ($row = $res->fetch_assoc()) {
                echo '<option value="' . $row['idteam'] . '">' . $row['name'] . '</option>';
            }
            
            echo '</select>';
            echo '</div>';
        }
    ?>

    <div class="form">
        <label>Pemain</label>
        <select id="idmember" name="idmember">
            <?php
                $stmt = $mysqli->prepare("select * From member");
                $stmt->execute();
                $res = $stmt->get_result();
                while($row = $res->fetch_assoc()) {
                    echo "<option value='".$row['idmember']."'>".$row['fname']." ".$row['lname']."</option>";
                }
            ?>
        </select>
    </div>

    <div class="form">
        <label for="description">Proposal Description:</label>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea>
    </div>

    <div class="form">
        <input type="submit" value="Submit Proposal">
    </div>

    </form>

</body>
</html>
