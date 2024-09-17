<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Achievement</title>
    <link rel="stylesheet" href="adminstyle.css">
</head>

<body>
    <?php if (isset($_GET['hasil']) && $_GET['hasil'] == 1) {
        echo "<p style='color: blue;'>Achievement added successfully!</p>";
    }
    ?>
    <div class="container">
        <h1>Add New Achievement</h1>
        <form action="add-proses.php" method="POST">
            <div class="form-group">
                <label for="idteam">Team Name:</label>
                <select name="idteam" id="idteam" required>
                    <option value="" disabled selected>Select a Team</option>
                    <?php
                    $mysqli = new mysqli("localhost", "root", "", "esport");

                    if ($mysqli->connect_error) {
                        die("Connection failed: " . $stmt->connect_error);
                    }

                    $sql = "SELECT idteam, name FROM team";
                    $stmt = $mysqli->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['idteam'] . "'>" . $row['name'] . "</option>";
                    }
                    $mysqli->close();
                    ?>
                </select>
            </div>
            <div class="form-group">

                <label for="name">Achievement Name:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Add">
            </div>

        </form>
    </div>
</body>

</html>