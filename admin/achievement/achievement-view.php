<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "SELECT a.idachievement, a.name AS achievement_name, a.date, a.description, t.name AS team_name 
        FROM achievement a 
        JOIN team t ON a.idteam = t.idteam";

$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Achievements List</title>
</head>
<body>
    <h1>Achievements</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Team</th>
            <th>Achievement Name</th>
            <th>Date</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['idachievement']; ?></td>
                <td><?php echo $row['team_name']; ?></td>
                <td><?php echo $row['achievement_name']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <a href="edit-ach.php?id=<?php echo $row['idachievement']; ?>">Edit</a>
                    <a href="delete-ach.php?id=<?php echo $row['idachievement']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

<?php
$stmt->close();
$mysqli->close();
?>
</body>
</html>
