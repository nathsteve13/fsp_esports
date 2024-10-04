<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team</title>
    <link rel="stylesheet" href="../../../public/css/style-admin.css"> <!-- External CSS, optional -->
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
            <li><a href="../achievement/achievement-view.php">Achievement</a></li>

        </ul>
    </div>

    <div class="main-content">
        <div class="form-container">
            <h1>Add New Team</h1>

            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <p class="success-message">Team added successfully!</p>
            <?php endif; ?>

            <form action="team-add-proses.php" method="POST">
                <div class="form-group">
                    <label for="name">Team Name:</label>
                    <input type="text" name="name" id="name" placeholder="Enter team name" required>
                </div>

                <div class="form-group">
                    <label for="idgame">Select Game:</label>
                    <select name="idgame" id="idgame" required>
                        <option value="">Select a game</option>
                        <?php while ($row = $games->fetch_assoc()): ?>
                            <option value="<?php echo htmlspecialchars($row['idgame']); ?>">
                                <?php echo htmlspecialchars($row['name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-button">Add Team</button>
                </div>
            </form>

            <div class="navigation-links">
                <a href="team-view.php" class="back-button">View Teams</a>
            </div>
        </div>
    </div>
</div>

</body>

</html>
