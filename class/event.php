<?php 

require_once("parent.php");

class Event extends ParentClass {
    public function __construct() {
        parent::__construct();
    }

    public function getTotalEvents() {
        $sql = "SELECT COUNT(*) as total FROM event";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
    public function countEvents()
    {
        $sql = "SELECT COUNT(*) AS total FROM event";
        $result = $this->mysqli->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }

    
    public function getEvents($offset = 0, $limit = 0) {
        $sql = "SELECT * FROM event";
        // $stmt = $this->mysqli->prepare($sql);

        if ($limit > 0) {
            $sql .= " LIMIT ?, ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param('ii', $offset, $limit);
        } else {
            $stmt = $this->mysqli->prepare($sql);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    public function getAvailableEvents() {
        $sql = "SELECT idevent, name, date FROM event ORDER BY date DESC";
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