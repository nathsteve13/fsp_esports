<?php

require_once("parent.php");

class JoinProposal extends ParentClass {
    public function __construct() {
        parent::__construct();
    }

    public function countProposalsByTeam($idteam) {
        $sql = "SELECT COUNT(*) AS total FROM join_proposal WHERE idteam = ? AND status = 'waiting'";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idteam);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function getProposalsByTeam($idteam, $limit, $offset) {
        $sql = "SELECT jp.idmember, m.fname, m.lname, m.username, jp.description, jp.status 
                FROM join_proposal jp
                JOIN member m ON jp.idmember = m.idmember
                WHERE jp.idteam = ? AND jp.status = 'waiting'
                LIMIT ? OFFSET ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("iii", $idteam, $limit, $offset);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function acceptProposal($idteam, $idmember) {
        // Cek apakah anggota sudah ada di team_members
        $sql = "SELECT * FROM team_members WHERE idteam = ? AND idmember = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ii", $idteam, $idmember);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 0) { // Jika anggota belum ada
            // Lakukan insert
            $sql = "INSERT INTO team_members (idteam, idmember) VALUES (?, ?)";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("ii", $idteam, $idmember);
            $stmt->execute();
        }
        // Update status menjadi 'approved'
        $sql = "UPDATE join_proposal SET status = 'approved' WHERE idteam = ? AND idmember = ?";
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
        $sql = "UPDATE join_proposal SET status = 'rejected' WHERE idteam = ? AND idmember = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ii", $idteam, $idmember);
        return $stmt->execute();
    }

    public function addProposal($idteam,$idmember,$description){
        $sql = "INSERT INTO join_proposal (idmember,idteam,description,status) 
        VALUES (?,?,?,?)";
        $status = 'waiting';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("iiss", $idmember, $idteam,$description,$status);
        $stmt->execute();
        return $stmt->insert_id;
    }
}
?>
