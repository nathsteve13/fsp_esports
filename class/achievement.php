<?php

require_once("parent.php");

class Achievement extends ParentClass
{
    public function __construct()
    {
        parent::__construct();
    }
    public function countAchievements()
    {
        $sql = "SELECT COUNT(*) AS total FROM achievement";
        $result = $this->mysqli->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function getAchievements($offset = 0, $limit = 0)
    {
        $sql = "SELECT a.idachievement, a.name AS achievement_name, a.date, a.description, t.name AS team_name 
                FROM achievement a 
                JOIN team t ON a.idteam = t.idteam";

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

    public function addAchievement($idteam, $name, $date, $description)
    {
        $sql = "INSERT INTO achievement (idteam, name, date, description) VALUES (?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("isss", $idteam, $name, $date, $description);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function getAchievementById($id)
    {
        $sql = "SELECT * FROM achievement WHERE idachievement = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateAchievement($idachievement, $idteam, $name, $date, $description)
    {
        $sql = "UPDATE achievement SET idteam=?, name=?, date=?, description=? WHERE idachievement=?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("isssi", $idteam, $name, $date, $description, $idachievement);
        return $stmt->execute();
    }

    public function deleteAchievement($idachievement)
    {
        $sql = "DELETE FROM achievement WHERE idachievement = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idachievement);
        return $stmt->execute();
    }

    public function getTeams()
    {
        $sql = "SELECT idteam, name FROM team";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }
}
