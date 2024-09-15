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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .card-grid {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 20px;
        }
        .card-content {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 250px;
            margin: 10px;
            padding: 20px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        .card-content:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .card-name {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }
        .card-meta {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        .card-actions {
            margin-top: 15px;
        }
        .card-actions a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
            font-weight: bold;
        }
        .card-actions a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Achievements</h1>
    <div class="card-grid">
        <?php while ($row = $result->fetch_assoc()) { ?>
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
        <?php } ?>
    </div>

<?php
$stmt->close();
$mysqli->close();
?>
</body>
</html>
