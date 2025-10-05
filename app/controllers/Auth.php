<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    public function login() {
        $error = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = $user;
                header("Location: index.php"); 
                exit;
            } else {
                $error = "Email atau password salah!";
            }
        }

        include __DIR__ . '/../views/auth/login.php';
    }
}
