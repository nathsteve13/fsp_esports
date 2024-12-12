<?php

require_once("parent.php");

class TeamMembers extends ParentClass
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getMembersByTeam($idteam)
    {
        $sql = "SELECT tm.idmember, m.fname, m.lname, m.username 
                FROM team_members tm
                JOIN member m ON tm.idmember = m.idmember
                WHERE tm.idteam = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idteam);
        $stmt->execute();
        return $stmt->get_result();
    }
    

    public function deleteMemberFromTeam($idteam, $idmember)
    {
        $sql = "DELETE FROM team_members WHERE idteam = ? AND idmember = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("ii", $idteam, $idmember);
        return $stmt->execute();
    }
}
