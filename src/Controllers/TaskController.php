<?php

require_once __DIR__ . '/AuthController.php';

class TaskController 
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = require __DIR__ . '/../Core/connection.php';
    }

    public function index(): void
    {
        AuthController::check();

        $user_id = $_SESSION['user_id'];

        $stmt = $this->pdo->prepare("
                SELECT *
                FROM tasks
                WHERE user_id = :user_id
                ORDER BY due_date ASC
            ");

        $stmt->execute([
            'user_id' => $user_id
        ]);
            
        $tasks = $stmt->fetchAll();

        require __DIR__ . '/../Views/taskIndex.php';
    }

    public function create(): void
    {
        AuthController::check();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            AuthController::verifyCsrf();

            $user_id = $_SESSION['user_id'];

            $name = $_POST['name'];
            $due_date = $_POST['due_date'];
            $status = $_POST['status'];

            if ($name === '' || $due_date === '' || !in_array($status, ['active', 'completed'])) {
                $_SESSION['error'] = 'Please complete all fields.';
                header('Location: /tasks/create');
                exit;
            }

            $stmt = $this->pdo->prepare("
                INSERT INTO tasks (name, due_date, status, user_id)
                VALUES (:name, :due_date, :status, :user_id)
            ");

            $stmt->execute([
                'name' => $name,
                'due_date' => $due_date,
                'status' => $status,
                'user_id' => $user_id
            ]);

            header('Location: /tasks');
            exit;
        }

        require __DIR__ . '/../Views/TaskCreate.php';
    }

    public function update(): void
    {
        AuthController::check();

        $id = $_GET['id'] ?? $_POST['id'] ?? null;
        $user_id = $_SESSION['user_id'];
        
        if (!$id) 
        {
            $_SESSION['error'] = 'Task ID is required.';
            header('Location: /tasks');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            AuthController::verifyCsrf();

            $name = $_POST['name'];
            $due_date = $_POST['due_date'];
            $status = $_POST['status'];
            
            if($name === '' || $due_date === '' || !in_array($status, ['active', 'completed'])) 
            {
                $_SESSION['error'] = 'Please complete all fields';

                header('Location: /tasks/edit?id=' . $id);
                exit;
            }

            // Update task
            $stmt = $this->pdo->prepare("
                UPDATE tasks
                SET
                    name = :name,
                    due_date = :due_date,
                    status = :status
                WHERE id = :id
                AND user_id = :user_id
            ");

            $stmt->execute([
                'name' => $name,
                'due_date' => $due_date,
                'status' => $status,
                'id' => $id,
                'user_id' => $user_id
            ]);

            header('Location: /tasks');
            exit;
        }

        $stmt = $this->pdo->prepare("
            SELECT *
            FROM tasks
            WHERE id = :id
            AND user_id = :user_id
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id,
            'user_id' => $user_id
        ]);

        $task = $stmt->fetch();

        if (!$task) 
        {

            $_SESSION['error'] = 'Task not found.';

            header('Location: /tasks');
            exit;
        }

        require __DIR__ . '/../Views/taskUpdate.php';
    }

    public function delete(): void
    {
        AuthController::check();

        AuthController::verifyCsrf();
        
        $id = $_POST['id'];
        $user_id = $_SESSION['user_id'];

        if ($id) {
            $stmt = $this->pdo->prepare("
                DELETE FROM tasks
                WHERE id = :id
                AND user_id = :user_id
            ");

            $stmt->execute([
                'id' => $id,
                'user_id' => $user_id
            ]);
        }

        $_SESSION['success'] = 'Task deleted successfully.';
        header('Location: /tasks');
        exit;
    }
}