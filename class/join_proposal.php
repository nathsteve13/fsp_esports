<?php

require_once("parent.php");

class JoinProposal extends ParentClass {
    public function __construct() {
        parent::__construct();
    }

    public function getProposalsByTeam($idteam) {
        $sql = "SELECT jp.idmember, m.fname, m.lname, m.username, jp.status 
                FROM join_proposal jp
                JOIN member m ON jp.idmember = m.idmember
                WHERE jp.idteam = ? AND jp.status = 'pending'";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idteam);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function acceptProposal($idteam, $idmember) {
        $sql = "INSERT INTO team_members (idteam, idmember) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ii", $idteam, $idmember);
        $stmt->execute();

        $sql = "UPDATE join_proposal SET status = 'accepted' WHERE idteam = ? AND idmember = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ii", $idteam, $idmember);
        return $stmt->execute();
    }
    public function countJoinProposals()
    {
        $sql = "SELECT COUNT(*) AS total FROM join_proposal";
        $result = $this->mysqli->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }

    public function rejectProposal($idteam, $idmember) {
        $sql = "DELETE FROM join_proposal WHERE idteam = ? AND idmember = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ii", $idteam, $idmember);
        return $stmt->execute();
    }
}
?>
