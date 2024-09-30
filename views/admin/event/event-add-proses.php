<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/event.php");

$event = new Event();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    $is_added = $event->addEvent($name, $date, $description);

    if ($is_added) {
        header("Location: event-add.php?success=1");
        exit();
    } else {
        echo "Failed to add event.";
    }
} else {
    header("Location: event-add.php");
    exit();
}
?>
