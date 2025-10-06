<?php
require_once APP_PATH.'app/Models/Post.php';

class PostController {
    private $post;

    public function __construct() {
        if(session_status()==PHP_SESSION_NONE) session_start();
        if(!isset($_SESSION['user'])) header("Location: /CoreCMS/login");

        $this->post = new Post(Bootstrap::$db);
    }

    public function index() {
        $posts = $this->post->getAll();
        require APP_PATH.'app/Views/admin/posts/index.php';
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD']==='POST') {
            $_POST['user_id'] = $_SESSION['user']['id'];
            $this->post->create($_POST);
            header("Location: /CoreCMS/admin/posts");
            exit;
        }
        require APP_PATH.'app/Views/admin/posts/create.php';
    }

    public function edit() {
        $id = $_GET['id'];
        $post = $this->post->getById($id);
        if($_SERVER['REQUEST_METHOD']==='POST') {
            $this->post->update($id,$_POST);
            header("Location: /CoreCMS/admin/posts");
            exit;
        }
        require APP_PATH.'app/Views/admin/posts/edit.php';
    }

    public function delete() {
        $id = $_GET['id'];
        $this->post->delete($id);
        header("Location: /CoreCMS/admin/posts");
        exit;
    }
}
