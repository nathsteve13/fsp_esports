<?php

require_once("parent.php");

class Team extends ParentClass
{
    public function __construct()
    {
        parent::__construct();
    }
    public function countTeams()
    {
        $sql = "SELECT COUNT(*) AS total FROM team";
        $result = $this->mysqli->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    public function getTeams($offset = 0, $limit = 0)
    {
        $sql = "SELECT * FROM team";

        if ($limit > 0) {
            $sql .= " LIMIT ?, ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param('ii', $offset, $limit);
        } else {
            $stmt = $this->mysqli->prepare($sql);
        }

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    public function getAllTeams() //untuk tambah team ke event
    {
        $sql = "SELECT * FROM team";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    public function getTeamById($idteam)
    {
        $sql = "SELECT * FROM team WHERE idteam = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("i", $idteam);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function addTeam($name, $idgame)
    {
        $sql = "INSERT INTO team (name, idgame) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("si", $name, $idgame);

        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    public function editTeam($idteam, $name, $idgame)
    {
        $sql = "UPDATE team SET name = ?, idgame = ? WHERE idteam = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("sii", $name, $idgame, $idteam);
        return $stmt->execute();
    }

    public function deleteTeam($idteam)
    {
        $sql = "DELETE FROM team WHERE idteam = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("i", $idteam);
        return $stmt->execute();
    }
}
