<?php
require_once("../../../class/team.php");
require_once("../../paging.php");

$team = new Team();

$no_hal = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($no_hal - 1) * $limit;

$jumlahData = $team->countTeams();
$teams = $team->getTeams($offset, $limit);
$pagination = generate_page($jumlahData, $limit, '', $no_hal);

if (!$teams) {
    die("Failed to load teams data.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teams</title>
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
            <h1>Teams List</h1>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Team Name</th>
                        <th>Game Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($teams->num_rows > 0): ?>
                        <?php while ($row = $teams->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['idteam']); ?></td>
                                <td>
                                    <?php
                                    // Path relatif dari file ini ke gambar
                                    $imagePath = "../../../public/images/teams/" . $row['idteam'] . ".jpg";

                                    // Cek apakah file gambar ada menggunakan path relatif
                                    if (file_exists(__DIR__ . '/' . $imagePath)): ?>
                                        <img src="<?php echo $imagePath; ?>" alt="Team Logo" width="50">
                                    <?php else: ?>
                                        No logo
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['team_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['game_name']); ?></td>
                                <td>
                                    <a href="team-edit.php?id=<?php echo $row['idteam']; ?>">Edit</a> |
                                    <a href="team-delete.php?id=<?php echo $row['idteam']; ?>" onclick="return confirm('Are you sure?')">Delete</a> |
                                    <a href="team-member-view.php?id=<?php echo $row['idteam']; ?>">Members</a> |
                                    <a href="team-achievement-view.php?idteam=<?php echo $row['idteam']; ?>">Achievement</a> |
                                    <a href="team-events-view.php?idteam=<?php echo $row['idteam']; ?>">Events</a> |
                                    <a href="join-proposal-admin.php?idteam=<?php echo $row['idteam']; ?>">Join Proposal</a> |
                                    <a href="team-images-view.php?idteam=<?php echo $row['idteam']; ?>">Images</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No teams available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php echo $pagination; ?>
            </div>

            <a href="team-add.php" class="add-button">Add New Team</a>
            <a href="join-proposal-view-admin.php" class="add-button">View All Join Proposal</a>
        </div>
    </div>

</body>

</html>