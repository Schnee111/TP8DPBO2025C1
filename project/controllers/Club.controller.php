<?php
include_once("views/Club.view.php");
class ClubController {
    private $model;
    private $view;
    
    public function __construct() {
        $this->model = new Club();
        $this->view = new ClubView();
    }
    
    public function index() {
        $clubs = $this->model->getAll();
        $this->view->showAll($clubs);
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->setName($_POST['name']);
            $this->model->setDescription($_POST['description']);
            $this->model->setFoundedDate($_POST['founded_date']);
            
            if ($this->model->save()) {
                header('Location: club.php');
                exit;
            }
        }
        
        $this->view->showAddForm();
    }
    
    public function edit() {
        if (!isset($_GET['id'])) {
            header('Location: club.php');
            exit;
        }
        
        $id = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->setId($id);
            $this->model->setName($_POST['name']);
            $this->model->setDescription($_POST['description']);
            $this->model->setFoundedDate($_POST['founded_date']);
            
            if ($this->model->save()) {
                header('Location: club.php');
                exit;
            }
        }
        
        if ($this->model->getById($id)) {
            $this->view->showEditForm($this->model);
        } else {
            header('Location: club.php');
            exit;
        }
    }
    
    public function delete() {
        if (!isset($_GET['id'])) {
            header('Location: club.php');
            exit;
        }
        
        $id = $_GET['id'];
        
        if ($this->model->delete($id)) {
            header('Location: club.php');
            exit;
        }
    }
}
?>