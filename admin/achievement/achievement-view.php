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
    <link rel="stylesheet" href="adminstyle.css">
</head>
<body>
    <h1 style="text-align: center;">Achievements</h1>
    <div class="card-grid">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class='card-card'>
                <div class="card-content">
                    <div class="card-name"><?php echo $row['achievement_name']; ?></div>
                    <div class="card-meta"><strong>Team:</strong> <?php echo $row['team_name']; ?></div>
                    <div class="card-meta"><strong>Description:</strong> <?php echo $row['description']; ?></div>
                    <div class="card-meta"><strong>Date:</strong> <?php echo $row['date']; ?></div>
                    <div class="card-actions">
                        <a href="edit-ach.php?id=<?php echo $row['idachievement']; ?>">Ubah Data</a>
                        <a href="delete-ach.php?id=<?php echo $row['idachievement']; ?>" onclick="return confirm('Are you sure?')">Hapus Data</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

<?php
$stmt->close();
$mysqli->close();
?>

<a href="add-ach.php" class="insert-button">New Achievement</a>
<a href="../../index.php" class="insert-button">Back to home</a>
</body>
</html>
