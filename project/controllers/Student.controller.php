<?php
include_once("views/Student.view.php");
class StudentController {
    private $model;
    private $view;
    
    public function __construct() {
        $this->model = new Student();
        $this->view = new StudentView();
    }
    
    public function index() {
        $students = $this->model->getAll();
        $this->view->showAll($students);
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->setName($_POST['name']);
            $this->model->setNim($_POST['nim']);
            $this->model->setPhone($_POST['phone']);
            $this->model->setJoinDate($_POST['join_date']);
            
            if ($this->model->save()) {
                header('Location: student.php');
                exit;
            }
        }
        
        $this->view->showAddForm();
    }
    
    public function edit() {
        if (!isset($_GET['id'])) {
            header('Location: student.php');
            exit;
        }
        
        $id = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->setId($id);
            $this->model->setName($_POST['name']);
            $this->model->setNim($_POST['nim']);
            $this->model->setPhone($_POST['phone']);
            $this->model->setJoinDate($_POST['join_date']);
            
            if ($this->model->save()) {
                header('Location: student.php');
                exit;
            }
        }
        
        if ($this->model->getById($id)) {
            $this->view->showEditForm($this->model);
        } else {
            header('Location: student.php');
            exit;
        }
    }
    
    public function delete() {
        if (!isset($_GET['id'])) {
            header('Location: student.php');
            exit;
        }
        
        $id = $_GET['id'];
        
        if ($this->model->delete($id)) {
            header('Location: student.php');
            exit;
        }
    }
}
?>