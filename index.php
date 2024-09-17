<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Logo di kiri -->
            <a class="navbar-brand" href="#">
                <img src="images/logoubaya.png" alt="Logo" width="40" height="40" class="d-inline-block align-top">
            </a>
            
            <!-- Toggler untuk tampilan mobile -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin/team/team-read.php">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/member/member-read.php">Member</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/game/game-read.php">Game</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/event/event-view.php">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/achievement/achievement-view.php">Achievement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/join-proposal-approval.php">Join Proposal Approval</a>
                    </li>
                </ul>
            </div>
            
            <!-- login -->
            <div class="navbar-right">
                <a href="#" class="btn btn-light rounded-pill">
                    <i class="fas fa-user"></i> Masuk ke Akun
                </a>
            </div>
        </div>
    </nav>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
