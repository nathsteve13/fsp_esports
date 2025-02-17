<?php

require_once("parent.php");

class Team extends ParentClass
{
    public function __construct()
    {
        parent::__construct();
    }
    public function countTeams($filter = '')
    {
        $sql = "SELECT COUNT(*) AS total FROM team";
        if (!empty($filter)) {
            $sql .= " WHERE name LIKE '%$filter%'";
        }
        $result = $this->mysqli->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }


    public function getEventsByTeam($idteam, $offset = 0, $limit = 10, $filter = '')
    {
        $sql = "
        SELECT event.idevent, event.name AS event_name, event.date, event.description
        FROM event
        JOIN event_teams ON event.idevent = event_teams.idevent
        WHERE event_teams.idteam = ?";

        if (!empty($filter)) {
            $sql .= " AND event.name LIKE ?";
            $filterParam = "%" . $filter . "%";
        }

        $sql .= " LIMIT ?, ?";

        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        if (!empty($filter)) {
            $stmt->bind_param("isii", $idteam, $filterParam, $offset, $limit);
        } else {
            $stmt->bind_param("iii", $idteam, $offset, $limit);
        }

        $stmt->execute();
        return $stmt->get_result();
    }


    public function countEventsByTeam($idteam, $filter = '')
    {
        $sql = "
            SELECT COUNT(*) as total
            FROM event
            JOIN event_teams ON event.idevent = event_teams.idevent
            WHERE event_teams.idteam = ?";
        if (!empty($filter)) {
            $sql .= " AND event.name LIKE '%$filter%'";
        }
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

    public function getAchievementsByTeam($idteam, $offset = 0, $limit = 0, $filter = '')
    {
        $sql = "SELECT a.idachievement, a.name, a.date, a.description 
                FROM team as t
                JOIN achievement as a ON t.idteam = a.idteam
                WHERE t.idteam = ?";

        if (!empty($filter)) {
            $sql .= " AND a.name LIKE ?";
            $filterParam = "%" . $filter . "%";
        }

        if ($limit > 0) {
            $sql .= " LIMIT ?, ?";
            $stmt = $this->mysqli->prepare($sql);

            if (!empty($filter)) {
                $stmt->bind_param('isii', $idteam, $filterParam, $offset, $limit);
            } else {
                $stmt->bind_param('iii', $idteam, $offset, $limit);
            }
        } else {
            $stmt = $this->mysqli->prepare($sql);

            if (!empty($filter)) {
                $stmt->bind_param('is', $idteam, $filterParam);
            } else {
                $stmt->bind_param('i', $idteam);
            }
        }

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    public function countAchievementsByTeam($idteam, $filter = '')
    {
        $sql = "SELECT COUNT(*) as total FROM achievement WHERE idteam = ?";
        if (!empty($filter)) {
            $sql .= " AND name LIKE '%$filter%'";
        }
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

    public function getTeams($offset = 0, $limit = 0, $filter = '')
    {
        $sql = "SELECT team.idteam, team.name AS team_name, game.name AS game_name 
                FROM team 
                JOIN game ON team.idgame = game.idgame
                WHERE team.name LIKE ?";
        if ($limit > 0) {
            $sql .= " LIMIT ?, ?";
        }
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }
        $filter = "%" . $filter . "%";

        if ($limit > 0) {
            $stmt->bind_param('sii', $filter, $offset, $limit);
        } else {
            $stmt->bind_param('s', $filter);
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
