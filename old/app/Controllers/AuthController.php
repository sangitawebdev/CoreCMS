<?php
namespace App\Controllers;

use App\Core\Controller;
use Bootstrap;

class AuthController extends Controller {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];  

            $stmt = Bootstrap::$db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = $user;
                header("Location: /CoreCMS/dashboard");
                exit;
            } else {
                $this->view('login', ['error' => 'Invalid credentials']);
            }
        }else {
            $this->view('login');
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /CoreCMS/login");
    }

    public function dashboard() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /CoreCMS/login");
            exit;
        }

        $this->view('dashboard', ['user' => $_SESSION['user']]);
    }
}
