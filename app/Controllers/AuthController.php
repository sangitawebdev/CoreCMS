<?php
namespace App\Controllers;

use App\Core\Controller;
use Bootstrap;

class AuthController extends Controller {

public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];  

        // Use WordPress-style column names
        $stmt = Bootstrap::$db->prepare("SELECT * FROM users WHERE user_email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['user_pass'])) {
            session_start();
            $_SESSION['user'] = $user;
            header("Location: " . BASE_URL . "/dashboard");
            exit;
        } else {
            $this->view('login', ['error' => 'Invalid credentials']);
        }
    } else {
        $this->view('login');
    }
}


    public function logout() {
        session_start();
        session_destroy();
        header("Location: ./login");
    }

    public function dashboard() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: ./login");
            exit;
        }

        $this->view('dashboard', ['user' => $_SESSION['user']]);
    }
}
