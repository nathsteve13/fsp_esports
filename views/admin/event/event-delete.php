<?php
require_once("../../../class/event.php");

$event = new Event();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $is_deleted = $event->deleteEvent($id);

    if ($is_deleted) {
        header("Location: event-view.php?success=1");
        exit();
    } else {
        echo "Failed to delete event.";
    }
}
?>
