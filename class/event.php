<?php 

require_once("parent.php");

class Event extends ParentClass {
    public function __construct() {
        parent::__construct();
    }

    public function getEvents() {
        $sql = "SELECT * FROM event";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    public function getEventById($idevent) {
        $sql = "SELECT * FROM event WHERE idevent = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("i", $idevent);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc(); 
    }

    public function addEvent($name, $date, $description) {
        $sql = "INSERT INTO event (name, date, description) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("sss", $name, $date, $description);

        if ($stmt->execute()) {
            return $stmt->insert_id;  
        } else {
            return false;
        }
    }

    public function editEvent($idevent, $name, $date, $description) {
        $sql = "UPDATE event SET name = ?, date = ?, description = ? WHERE idevent = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("sssi", $name, $date, $description, $idevent);

        return $stmt->execute();  
    }

    public function deleteEvent($idevent) {
        $sql = "DELETE FROM event WHERE idevent = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("i", $idevent);

        return $stmt->execute();  
    }
}
?>