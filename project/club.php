<?php
include_once("conf.php");
include_once("controllers/Club.controller.php");

$controller = new ClubController();

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($action) {
    case 'add':
        $controller->add();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
        break;
}
?>