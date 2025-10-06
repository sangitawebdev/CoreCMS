<?php
require_once APP_PATH.'app/Models/User.php';

class UserController {
    private $user;

    public function __construct() {
        if(session_status()==PHP_SESSION_NONE) session_start();
        if(!isset($_SESSION['user'])) header("Location: /CoreCMS/login");

        $this->user = new User(Bootstrap::$db);
    }

    public function index() {
        $users = $this->user->getAll();
        require APP_PATH.'app/Views/admin/users/index.php';
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD']==='POST') {
            $this->user->create($_POST);
            header("Location: /CoreCMS/admin/users");
            exit;
        }
        require APP_PATH.'app/Views/admin/users/create.php';
    }

    public function edit() {
        $id = $_GET['id'];
        $user = $this->user->getById($id);
        if($_SERVER['REQUEST_METHOD']==='POST') {
            $this->user->update($id,$_POST);
            header("Location: /CoreCMS/admin/users");
            exit;
        }
        require APP_PATH.'app/Views/admin/users/edit.php';
    }

    public function delete() {
        $id = $_GET['id'];
        $this->user->delete($id);
        header("Location: /CoreCMS/admin/users");
        exit;
    }
}
