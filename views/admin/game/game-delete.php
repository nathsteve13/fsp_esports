<?php
require_once("../../../class/game.php");

$game = new Game();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $is_deleted = $game->deleteGame($id);

    if ($is_deleted) {
        header("Location: game-view.php?success=1");
        exit();
    } else {
        echo "Failed to delete game.";
    }
}
?>
