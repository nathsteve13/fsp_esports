<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member List</title>
</head>
<body>
    <?php 
        $mysqli = new mysqli("localhost", "root", "", "esport");
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }

        $sql = "SELECT member.fname, member.lname, member.username, member.idmember, team.name AS team_name
                FROM member
                LEFT JOIN team_members ON member.idmember = team_members.idmember
                LEFT JOIN team ON team_members.idteam = team.idteam";
        
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows == 0) {
            echo "No Member Found!";
        } else {
            while ($row = $res->fetch_assoc()) {
                echo "<div class='card-grid'>";
                echo "<div class='card-content'>";
                echo "<div class='card-name'>" . $row['fname'] . " " . $row['lname']. "</div>";
                echo "<div class='card-meta'>Username: " . $row['username'] . "</div>";
                
                if ($row['team_name']) {
                    echo "<div class='card-meta'>Team: " . $row['team_name'] . "</div>";
                } else {
                    echo "<div class='card-meta'>Team: No Team</div>";
                }

                echo "</div>";
                echo "<div class='card-actions'>";
                echo "<a href='member-update.php?idmember=" . $row['idmember'] . "'>Ubah Data</a>";
                echo "<a href='member-delete.php?idmember=" . $row['idmember'] . "'>Hapus Data</a>";
                echo "</div>";
                echo "</div>";
            }
        }
    ?>

    <a href="member-create.php">Add Member</a>
</body>
</html>
