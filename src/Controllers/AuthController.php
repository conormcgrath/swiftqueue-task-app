<?php

class AuthController
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = require __DIR__ . '/../Core/connection.php';
    }

    public function showLogin(): void
    {
        require __DIR__ . '/../Views/login.php';
    }

    public function login(): void
    {
        AuthController::verifyCsrf();

        $email = $_POST['email'];

        $password = $_POST['password'];
        
        $stmt = $this->pdo->prepare("
            SELECT * FROM users
            WHERE email = :email
            LIMIT 1
        ");

        $stmt->execute([
            'email' => $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || !password_verify($password, $user['password'])) {
            echo "Invalid email or password.";
            exit;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
            
        header("Location: /tasks");
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();

        header('Location: /login');
        exit;
    }

    public static function check(): void
    {
        if (!isset($_SESSION['user_id'])) {

            header('Location: /login');
            exit;
        }
    }

    public static function verifyCsrf(): void
    {
        if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            die('Invalid CSRF token');
        }
    }
}

