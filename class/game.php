<?php 

require_once("parent.php");

class Game extends ParentClass {
    public function __construct() {
        parent::__construct();
    }

    public function getGames() {
        $sql = "SELECT * FROM game";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    public function getGameById($idgame) {
        $sql = "SELECT * FROM game WHERE idgame = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("i", $idgame);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function addGame($name, $description) {
        $sql = "INSERT INTO game (name, description) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("ss", $name, $description);

        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    public function editGame($idgame, $name, $description) {
        $sql = "UPDATE game SET name = ?, description = ? WHERE idgame = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("ssi", $name, $description, $idgame);
        return $stmt->execute();
    }

    public function deleteGame($idgame) {
        $sql = "DELETE FROM game WHERE idgame = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("i", $idgame);
        return $stmt->execute();
    }
}
?>
