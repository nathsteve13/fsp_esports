<?php

require_once("parent.php");

class EventTeams extends ParentClass
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getTeamsByEvent($idevent)
    {
        $sql = "SELECT et.idteam, t.name 
                FROM event_teams et
                JOIN team t ON et.idteam = t.idteam
                WHERE et.idevent = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idevent);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function addTeamToEvent($idevent, $idteam)
    {
        $sql = "INSERT INTO event_teams (idevent, idteam) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ii", $idevent, $idteam);
        return $stmt->execute();
    }

    public function deleteTeamsFromEvent($idevent)
    {
        $sql = "DELETE FROM event_teams WHERE idevent = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idevent);
        return $stmt->execute();
    }

    public function getEventsByTeam($idteam)
    {
        $sql = "SELECT e.name AS event_name, e.date, e.description
                FROM event_teams et
                JOIN event e ON et.idevent = e.idevent
                WHERE et.idteam = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idteam);
        $stmt->execute();
        return $stmt->get_result();
    }
}
