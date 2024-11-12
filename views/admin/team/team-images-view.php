<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/team.php");

$team = new Team();

$idteam = isset($_GET['idteam']) ? $_GET['idteam'] : null;

if (!$idteam) {
    die("Team ID is required.");
}

// Dapatkan nama tim
$teamData = $team->getTeamById($idteam);
if (!$teamData) {
    die("Team data not found.");
}

// Ambil path gambar tim
$imagePath = "/public/images/teams/" . $idteam . ".jpg";
$imageExists = file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Team Image</title>
    <link rel="stylesheet" href="../../../public/css/style-admin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <h1>Team ID: <?php echo htmlspecialchars($idteam); ?></h1>

            <!-- Form Upload Gambar Team -->
            <div class="upload-section">
                <h2>Upload/Update Team Image</h2>
                <form id="frmData" enctype="multipart/form-data">
                    <input type="file" name="photo" id="photo" accept=".jpg" required>
                    <input type="hidden" name="namaFile" id="namaFile" value="<?php echo htmlspecialchars($idteam); ?>">
                    <button type="button" id="btnupload">Upload Gambar</button>
                </form>
            </div>

            <!-- Tabel untuk Menampilkan Nama dan Gambar Team -->
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Team Name</th>
                        <th>Team Image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($teamData['name']); ?></td>
                        <td>
                            <?php if ($imageExists): ?>
                                <img src="<?php echo $imagePath; ?>" alt="Team Image" width="100">
                            <?php else: ?>
                                <p>No image available.</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <a href="team-view.php" class="back-button">Back to Teams</a>
        </div>
    </div>

    <script>
        // JavaScript untuk mengirim data dengan AJAX
        $("body").on("click", "#btnupload", function() {
            var formData = new FormData($("#frmData")[0]);
            $.ajax({
                url: '../../upload_team_image.php',
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                success: function(response) {
                    alert(response);
                    location.reload(); // Refresh halaman setelah upload gambar berhasil
                }
            });
        });
    </script>

</body>

</html>