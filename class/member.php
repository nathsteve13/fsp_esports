<?php 

require_once("parent.php");

class Member extends ParentClass {
    public function __construct() 
    {
        parent::__construct();
    }

    public function getMember($username) {
        $sql = "SELECT * FROM member WHERE username = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res->fetch_assoc();
    }

    public function authenticate($username, $plain_pass) {
        $member = $this->getMember($username);

        if($member && password_verify($plain_pass, $member['password'])) {
            return $member;
        } else { 
            return false;
        }
    }

    public function addMember($fname, $lname, $username, $plain_pass) {
        $hashed_pass = password_hash($plain_pass, PASSWORD_DEFAULT);
        $profile = "member";

        $sql = "INSERT INTO member (fname, lname, username, password, profile) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        
        if (!$stmt) {
            die("Prepare statement failed: " . $this->mysqli->error);
        }

        $stmt->bind_param("sssss", $fname, $lname, $username, $hashed_pass, $profile);
        $stmt->execute();

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return $stmt->insert_id;  
            } else {
                return false; 
            }
        } else {
            die("Execute failed: " . $stmt->error);
        }
    }

    public function updateProfile($member_id, $profile) {
        $profile = "admin";
        $sql = "UPDATE member SET profile = ? WHERE idmember = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("si", $profile, $member_id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function deleteMember($member_id) {
        $sql = "DELETE FROM member WHERE idmember = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $member_id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }
}

?>