<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Achievement</title>
    <link rel="stylesheet" href="../../../public/css/style-admin.css"> 
</head>

<body>

<div class="dashboard-container">
    <div class="sidebar">
        <div class="logo">
            <img src="../../../public/images/logoubaya.png" alt="Logo">
        </div>
        <ul class="nav-links">
            <li><a href="../event/event-view.php">Events</a></li>
            <li><a href="../game/game-view.php">Games</a></li>
            <li><a href="../team/team-view.php">Teams</a></li>
            <li><a href="../member/member-view.php">Members</a></li>
            <li><a href="../achievement/achievement-view.php">Achievements</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="form-container">
            <h1>Add New Achievement</h1>
            
            <?php if (isset($_GET['hasil']) && $_GET['hasil'] == 1): ?>
                <p style="color: blue;">Achievement added successfully!</p>
            <?php endif; ?>

            <form action="achievement-add-proses.php" method="POST">
                <div class="form-group">
                    <label for="idteam">Team Name:</label>
                    <select name="idteam" id="idteam" required>
                        <option value="" disabled selected>Select a Team</option>
                        <?php
                        require_once($_SERVER['DOCUMENT_ROOT'] . "/class/achievement.php");
                        $achievement = new Achievement();
                        $teams = $achievement->getTeams();
                        while ($row = $teams->fetch_assoc()) {
                            echo "<option value='" . $row['idteam'] . "'>" . $row['name'] . "</option>";
                        }
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
                    <input type="submit" value="Add Achievement" class="submit-button">
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>
