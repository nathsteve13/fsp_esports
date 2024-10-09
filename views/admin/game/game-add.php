<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Game</title>
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
            <li><a href="../achievement/achievement-view.php">Achievement</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="form-container">
            <h1>Add New Game</h1>

            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <p style="color: green;">Game added successfully!</p>
            <?php endif; ?>

            <form action="game-add-proses.php" method="POST">
                <div class="form-group">
                    <label for="name">Game Name:</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-button">Add Game</button>
                </div>
            </form>
            <a href="game-view.php" class="back-button">View Games</a>
        </div>
    </div>
</div>

</body>

</html>
