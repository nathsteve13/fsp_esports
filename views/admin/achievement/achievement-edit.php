<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/achievement.php");

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Achievement</title>
    <link rel="stylesheet" href="../../../public/css/style-admin.css">
</head>

<body>

    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <a href="../dashboard.php"><img src="../../../public/images/logoubaya.png" alt="Logo"></a>
            </div>
            <ul class="nav-links">
                <li><a href="../event/event-view.php">Events</a></li>
                <li><a href="../game/game-view.php">Games</a></li>
                <li><a href="../team/team-view.php">Teams</a></li>
                <li><a href="../member/member-view.php">Members</a></li>
                <li><a href="../achievement/achievement-view.php">Achievement</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="form-container">
                <h1>Edit Achievement</h1>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="idteam">Team:</label>
                        <select name="idteam" id="idteam" required>
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
                        <label for="name">Achievement Name:</label>
                        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($achievementData['name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($achievementData['date']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" rows="4" required><?php echo htmlspecialchars($achievementData['description']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update Achievement" class="submit-button">
                    </div>
                </form>
                <a href="achievement-view.php" class="back-button">View Achievement</a>
            </div>
        </div>
    </div>

</body>

</html>