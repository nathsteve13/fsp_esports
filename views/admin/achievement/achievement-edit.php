<?php
require_once('Achievement.php');

$achievement = new Achievement();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $achievementData = $achievement->getAchievementById($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idteam = $_POST['idteam'];
        $name = $_POST['name'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        $achievement->updateAchievement($id, $idteam, $name, $date, $description);
        header("Location: achievement-view.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Achievement</title>
    <link rel="stylesheet" href="adminstyle.css">
</head>

<body>
    <div class="container">
        <h1>Edit Achievement</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label>Team:</label>
                <select name="idteam" required>
                    <?php
                    $teams = $achievement->getTeams();
                    while ($row = $teams->fetch_assoc()) {
                        $selected = $row['idteam'] == $achievementData['idteam'] ? 'selected' : '';
                        echo "<option value='" . $row['idteam'] . "' $selected>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Achievement Name:</label>
                <input type="text" name="name" value="<?php echo $achievementData['name']; ?>" required>
            </div>

            <div class="form-group">
                <label>Date:</label>
                <input type="date" name="date" value="<?php echo $achievementData['date']; ?>" required>
            </div>

            <div class="form-group">
                <label>Description:</label>
                <textarea name="description" rows="4" required><?php echo $achievementData['description']; ?></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Update Achievement">
            </div>
        </form>
    </div>
</body>

</html>
