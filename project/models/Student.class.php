<?php
class Student {
    private $id;
    private $name;
    private $nim;
    private $phone;
    private $join_date;
    private $db;
    
    public function __construct() {
        $this->db = DB::getInstance();
    }
    
    // Getters and setters
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getNim() { return $this->nim; }
    public function getPhone() { return $this->phone; }
    public function getJoinDate() { return $this->join_date; }
    
    public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setNim($nim) { $this->nim = $nim; }
    public function setPhone($phone) { $this->phone = $phone; }
    public function setJoinDate($join_date) { $this->join_date = $join_date; }
    
    // CRUD operations
    public function getAll() {
        $sql = "SELECT * FROM students ORDER BY name";
        $result = $this->db->query($sql);
        $students = [];
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
        }
        
        return $students;
    }
    
    public function getById($id) {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM students WHERE id = '$id'";
        $result = $this->db->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->nim = $row['nim'];
            $this->phone = $row['phone'];
            $this->join_date = $row['join_date'];
            return true;
        }
        
        return false;
    }
    
    public function save() {
        $name = $this->db->escape($this->name);
        $nim = $this->db->escape($this->nim);
        $phone = $this->db->escape($this->phone);
        $join_date = $this->db->escape($this->join_date);
        
        if ($this->id) {
            // Update
            $sql = "UPDATE students SET name = '$name', nim = '$nim', phone = '$phone', join_date = '$join_date' WHERE id = '{$this->id}'";
            return $this->db->query($sql);
        } else {
            // Insert
            $sql = "INSERT INTO students (name, nim, phone, join_date) VALUES ('$name', '$nim', '$phone', '$join_date')";
            if ($this->db->query($sql)) {
                $this->id = $this->db->getLastId();
                return true;
            }
            return false;
        }
    }
    
    public function delete($id) {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM students WHERE id = '$id'";
        return $this->db->query($sql);
    }
}
?>