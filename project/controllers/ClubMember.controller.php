<?php
include_once("views/ClubMember.view.php");
class ClubMemberController {
    private $model;
    private $view;
    private $studentModel;
    private $clubModel;
    
    public function __construct() {
        $this->model = new ClubMember();
        $this->view = new ClubMemberView();
        $this->studentModel = new Student();
        $this->clubModel = new Club();
    }
    
    public function index() {
        $members = $this->model->getAll();
        $this->view->showAll($members);
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->setStudentId($_POST['student_id']);
            $this->model->setClubId($_POST['club_id']);
            $this->model->setJoinDate($_POST['join_date']);
            $this->model->setRole($_POST['role']);
            
            if ($this->model->save()) {
                header('Location: club_member.php');
                exit;
            }
        }
        
        $students = $this->studentModel->getAll();
        $clubs = $this->clubModel->getAll();
        $this->view->showAddForm($students, $clubs);
    }
    
    public function edit() {
        if (!isset($_GET['id'])) {
            header('Location: club_member.php');
            exit;
        }
        
        $id = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->setId($id);
            $this->model->setStudentId($_POST['student_id']);
            $this->model->setClubId($_POST['club_id']);
            $this->model->setJoinDate($_POST['join_date']);
            $this->model->setRole($_POST['role']);
            
            if ($this->model->save()) {
                header('Location: club_member.php');
                exit;
            }
        }
        
        if ($this->model->getById($id)) {
            $students = $this->studentModel->getAll();
            $clubs = $this->clubModel->getAll();
            $this->view->showEditForm($this->model, $students, $clubs);
        } else {
            header('Location: club_member.php');
            exit;
        }
    }
    
    public function delete() {
        if (!isset($_GET['id'])) {
            header('Location: club_member.php');
            exit;
        }
        
        $id = $_GET['id'];
        
        if ($this->model->delete($id)) {
            header('Location: club_member.php');
            exit;
        }
    }
}
?>