<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .insert-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px 20px;
            text-align: center;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .insert-button:hover {
            background-color: #0056b3;
        }

        .game-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .game-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s;
        }

        .game-card:hover {
            transform: scale(1.05);
        }

        .game-content {
            padding: 15px;
        }

        .game-title {
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 10px;
        }

        .game-meta {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .game-actions {
            text-align: center;
            padding: 10px;
            background-color: #f9f9f9;
            border-top: 1px solid #eee;
        }

        .game-actions a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            margin: 0 10px;
        }

        .game-actions a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    
    <?php 
        $mysqli = new mysqli("localhost", "root", "", "esport");
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }

        $sqlevent = "select * from event";
        $stmt = $mysqli->prepare($sqlevent);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows == 0) {
            echo "No events found!";
        } else {
            echo "<div class='event-grid'>";
            while ($row = $res->fetch_assoc()) {
                echo "<div class='event-card'>";
                echo "<div class='event-content'>";
                echo "<div class='event-name'>" . $row['name'] . "</div>";
                echo "<div class='event-meta'>Description: " . $row['description'] . "</div>";
                echo "</div>";
                echo "<div class='event-actions'>";
                echo "<a href='event-management-update-proses.php?idevent=" . $row['idevent'] . "'>Ubah Data</a>";
                echo "<a href='event-management-delete-proses.php?idevent=" . $row['idevent'] . "'>Hapus Data</a>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        }
    ?>
</body>
</html>