<?php
require_once("../../../class/game.php");

$game = new Game();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $is_added = $game->addGame($name, $description);

    if ($is_added) {
        header("Location: game-add.php?success=1");
        exit();
    } else {
        echo "Failed to add game.";
    }
} else {
    header("Location: game-add.php");
    exit();
}
?>
