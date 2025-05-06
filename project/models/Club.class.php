<?php
class Club {
    private $id;
    private $name;
    private $description;
    private $founded_date;
    private $db;
    
    public function __construct() {
        $this->db = DB::getInstance();
    }
    
    // Getters and setters
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getDescription() { return $this->description; }
    public function getFoundedDate() { return $this->founded_date; }
    
    public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setDescription($description) { $this->description = $description; }
    public function setFoundedDate($founded_date) { $this->founded_date = $founded_date; }
    
    // CRUD operations
    public function getAll() {
        $sql = "SELECT * FROM clubs ORDER BY name";
        $result = $this->db->query($sql);
        $clubs = [];
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $clubs[] = $row;
            }
        }
        
        return $clubs;
    }
    
    public function getById($id) {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM clubs WHERE id = '$id'";
        $result = $this->db->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->founded_date = $row['founded_date'];
            return true;
        }
        
        return false;
    }
    
    public function save() {
        $name = $this->db->escape($this->name);
        $description = $this->db->escape($this->description);
        $founded_date = $this->db->escape($this->founded_date);
        
        if ($this->id) {
            // Update
            $sql = "UPDATE clubs SET name = '$name', description = '$description', founded_date = '$founded_date' WHERE id = '{$this->id}'";
            return $this->db->query($sql);
        } else {
            // Insert
            $sql = "INSERT INTO clubs (name, description, founded_date) VALUES ('$name', '$description', '$founded_date')";
            if ($this->db->query($sql)) {
                $this->id = $this->db->getLastId();
                return true;
            }
            return false;
        }
    }
    
    public function delete($id) {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM clubs WHERE id = '$id'";
        return $this->db->query($sql);
    }
}
?>