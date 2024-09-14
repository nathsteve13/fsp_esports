<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM achievement WHERE idachievement = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $achievement = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idteam = $_POST['idteam'];
        $name = $_POST['name'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        $sql = "UPDATE achievement SET idteam=?, name=?, date=?, description=? WHERE idachievement=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("isssi", $idteam, $name, $date, $description, $id);

        if ($stmt->execute()) {
            echo "Achievement updated successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Achievement</title>
</head>
<body>
    <h1>Edit Achievement</h1>
    <form method="POST" action="">
        <label>Team:</label>
        <select name="idteam">
            <?php
            $mysqli = new mysqli("localhost", "root", "", "esport");
            $sql = "SELECT idteam, name FROM team";
            $stmt = $mysqli->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $selected = $row['idteam'] == $achievement['idteam'] ? 'selected' : '';
                echo "<option value='" . $row['idteam'] . "' $selected>" . $row['name'] . "</option>";
            }

            $stmt->close();
            $mysqli->close();
            ?>
        </select><br><br>

        <label>Achievement Name:</label>
        <input type="text" name="name" value="<?php echo $achievement['name']; ?>" required><br><br>

        <label>Date:</label>
        <input type="date" name="date" value="<?php echo $achievement['date']; ?>" required><br><br>

        <label>Description:</label>
        <textarea name="description"><?php echo $achievement['description']; ?></textarea><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
