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

}