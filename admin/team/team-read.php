<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Data</title>
</head>
<body>
    <?php 
        $mysqli = new mysqli("localhost", "root", "", "esport");
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }

        $sql = "SELECT team.idteam, team.name AS team_name, game.name AS game_name
                FROM team
                LEFT JOIN game ON team.idgame = game.idgame";
        
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows == 0) {
            echo "No Team Found!";
        } else {
            while ($row = $res->fetch_assoc()) {
                echo "<div class='card-grid'>";
                echo "<h2>Team: " . $row['team_name'] . "</h2>";
                echo "<p>Game: " . $row['game_name'] . "</p>";
                
                $idteam = $row['idteam'];
                $members_sql = "SELECT member.fname, member.lname 
                                FROM team_members 
                                LEFT JOIN member ON team_members.idmember = member.idmember 
                                WHERE team_members.idteam = ?";
                $members_stmt = $mysqli->prepare($members_sql);
                $members_stmt->bind_param('i', $idteam);
                $members_stmt->execute();
                $members_result = $members_stmt->get_result();

                if ($members_result->num_rows > 0) {
                    echo "<p>Team Members:</p>";
                    echo "<ul>";
                    while ($member_row = $members_result->fetch_assoc()) {
                        echo "<li>" . $member_row['fname'] . " " . $member_row['lname'] . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No members in this team.</p>";
                }

                echo "</div>";
                echo "<div class='card-actions'>";
                echo "<a href='team-update.php?idteam=" . $row['idteam'] . "'>Ubah Data</a>";
                echo "<a href='team-delete.php?idteam=" . $row['idteam'] . "'>Hapus Data</a>";
                echo "</div>";
                echo "</div>";
            }
        }

        $stmt->close();
        $mysqli->close();
    ?>
</body>
</html>
