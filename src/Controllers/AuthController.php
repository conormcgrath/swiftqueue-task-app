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

    public function register(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            AuthController::verifyCsrf();

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if( $name === '' || $email === '' || $password === '' || $confirm_password === '') 
            {
                $_SESSION['error'] = 'All fields are required.';

                header('Location: /register');
                exit;
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $_SESSION['error'] = 'Invalid email address.';

                header('Location: /register');
                exit;
            }

            if($password !== $confirm_password) 
            {
                $_SESSION['error'] = 'Passwords do not match.';

                header('Location: /register');
                exit;
            }

            $stmt = $this->pdo->prepare("
                SELECT id
                FROM users
                WHERE email = :email
                LIMIT 1
            ");

            $stmt->execute([
                'email' => $email
            ]);

            $existing_user = $stmt->fetch();

            if($existing_user) 
            {
                $_SESSION['error'] = 'Email address already registered.';

                header('Location: /register');
                exit;
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare("
                INSERT INTO users (
                    name,
                    email,
                    password
                )
                VALUES (
                    :name,
                    :email,
                    :password
                )
            ");

            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password
            ]);

            $user_id = $this->pdo->lastInsertId();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $name;

            $_SESSION['success'] = 'Registration successful.';

            header('Location: /tasks');
            exit;
        }

        require __DIR__ . '/../Views/register.php';
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

