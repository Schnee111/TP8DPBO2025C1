<?php
class ClubMember {
    private $id;
    private $student_id;
    private $club_id;
    private $join_date;
    private $role;
    private $db;
    
    public function __construct() {
        $this->db = DB::getInstance();
    }
    
    // Getters and setters
    public function getId() { return $this->id; }
    public function getStudentId() { return $this->student_id; }
    public function getClubId() { return $this->club_id; }
    public function getJoinDate() { return $this->join_date; }
    public function getRole() { return $this->role; }
    
    public function setId($id) { $this->id = $id; }
    public function setStudentId($student_id) { $this->student_id = $student_id; }
    public function setClubId($club_id) { $this->club_id = $club_id; }
    public function setJoinDate($join_date) { $this->join_date = $join_date; }
    public function setRole($role) { $this->role = $role; }
    
    // CRUD operations
    public function getAll() {
        $sql = "SELECT cm.*, s.name as student_name, c.name as club_name 
                FROM club_members cm
                JOIN students s ON cm.student_id = s.id
                JOIN clubs c ON cm.club_id = c.id
                ORDER BY c.name, s.name";
        $result = $this->db->query($sql);
        $members = [];
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $members[] = $row;
            }
        }
        
        return $members;
    }
    
    public function getById($id) {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM club_members WHERE id = '$id'";
        $result = $this->db->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->student_id = $row['student_id'];
            $this->club_id = $row['club_id'];
            $this->join_date = $row['join_date'];
            $this->role = $row['role'];
            return true;
        }
        
        return false;
    }
    
    public function getByStudentAndClub($student_id, $club_id) {
        $student_id = $this->db->escape($student_id);
        $club_id = $this->db->escape($club_id);
        $sql = "SELECT * FROM club_members WHERE student_id = '$student_id' AND club_id = '$club_id'";
        $result = $this->db->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->student_id = $row['student_id'];
            $this->club_id = $row['club_id'];
            $this->join_date = $row['join_date'];
            $this->role = $row['role'];
            return true;
        }
        
        return false;
    }
    
    public function save() {
        $student_id = $this->db->escape($this->student_id);
        $club_id = $this->db->escape($this->club_id);
        $join_date = $this->db->escape($this->join_date);
        $role = $this->db->escape($this->role);
        
        if ($this->id) {
            // Update
            $sql = "UPDATE club_members SET student_id = '$student_id', club_id = '$club_id', join_date = '$join_date', role = '$role' WHERE id = '{$this->id}'";
            return $this->db->query($sql);
        } else {
            // Insert
            $sql = "INSERT INTO club_members (student_id, club_id, join_date, role) VALUES ('$student_id', '$club_id', '$join_date', '$role')";
            if ($this->db->query($sql)) {
                $this->id = $this->db->getLastId();
                return true;
            }
            return false;
        }
    }
    
    public function delete($id) {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM club_members WHERE id = '$id'";
        return $this->db->query($sql);
    }
    
    public function deleteByStudentAndClub($student_id, $club_id) {
        $student_id = $this->db->escape($student_id);
        $club_id = $this->db->escape($club_id);
        $sql = "DELETE FROM club_members WHERE student_id = '$student_id' AND club_id = '$club_id'";
        return $this->db->query($sql);
    }
}
?>