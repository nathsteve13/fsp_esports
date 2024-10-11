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

    public function getEventsByTeam($idteam, $offset = 0, $limit = 10)
    {
        $sql = "
            SELECT event.idevent, event.name AS event_name, event.date, event.description
            FROM event
            JOIN event_teams ON event.idevent = event_teams.idevent
            WHERE event_teams.idteam = ?
            LIMIT ?, ?";

        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("iii", $idteam, $offset, $limit);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function countEventsByTeam($idteam)
    {
        $sql = "
            SELECT COUNT(*) as total
            FROM event
            JOIN event_teams ON event.idevent = event_teams.idevent
            WHERE event_teams.idteam = ?";

        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("i", $idteam);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function getAchievementsByTeam($idteam, $offset = 0, $limit = 0)
    {
        $sql = "SELECT a.idachievement, a.name, a.date, a.description FROM team as t
            JOIN achievement as a ON t.idteam = a.idteam
            WHERE t.idteam = ?";

        if ($limit > 0) {
            $sql .= " LIMIT ?, ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param('iii', $idteam, $offset, $limit);
        } else {
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param('i', $idteam);
        }

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    public function countAchievementsByTeam($idteam)
    {
        $sql = "SELECT COUNT(*) as total FROM achievement WHERE idteam = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param('i', $idteam);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['total'];
    }
    public function getTeamsByGameId($idgame)
    {
        $sql = "SELECT idteam, name 
                FROM team 
                WHERE idgame = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("i", $idgame);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getTeams($offset = 0, $limit = 0)
    {
        $sql = "SELECT team.idteam, team.name AS team_name, game.name AS game_name 
            FROM team 
            JOIN game ON team.idgame = game.idgame";

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

    public function removeEventFromTeam($idteam, $idevent)
    {
        $sql = "DELETE FROM event_teams WHERE idteam = ? AND idevent = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ii", $idteam, $idevent);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
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
