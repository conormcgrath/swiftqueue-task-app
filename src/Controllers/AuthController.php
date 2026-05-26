<?php

// Controller for user authentication and session management
class AuthController
{
    private PDO $pdo;

    // Load PDO database connection
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
        // Verify CSRF token before processing POST request
        AuthController::verifyCsrf();

        $email = $_POST['email'];

        $password = $_POST['password'];
        
        // Find user account using submitted email address
        $stmt = $this->pdo->prepare("
            SELECT * FROM users
            WHERE email = :email
            LIMIT 1
        ");

        $stmt->execute([
            'email' => $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // User and password validation check
        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Invalid email or password.';

            header('Location: /login');
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
            // Verify CSRF token before processing POST request
            AuthController::verifyCsrf();

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Form fields validation check
            if( $name === '' || $email === '' || $password === '' || $confirm_password === '') 
            {
                $_SESSION['error'] = 'All fields are required.';

                header('Location: /register');
                exit;
            }

            // Check email address formatting
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $_SESSION['error'] = 'Invalid email address.';

                header('Location: /register');
                exit;
            }

            // Password check
            if($password !== $confirm_password) 
            {
                $_SESSION['error'] = 'Passwords do not match.';

                header('Location: /register');
                exit;
            }

            // Check if there is an existing user with the same credentials
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

            // Create new user
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
        // Check if user has been authenticated
        if (!isset($_SESSION['user_id'])) {

            header('Location: /login');
            exit;
        }
    }

    public static function verifyCsrf(): void
    {
        // CSRF token validation check
        if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            die('Invalid CSRF token');
        }
    }
}

