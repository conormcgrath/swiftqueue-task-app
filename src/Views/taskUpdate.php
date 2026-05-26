<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Edit Task</title>
</head>

<body class="bg-light">

<?php
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>
  
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit Task</h2>

        <a href="/tasks" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>
    
    <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="/tasks/update">

        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

        <input type="hidden" name="id" value="<?= $task['id'] ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Task Name</label><br>
            <input type="text" id="name" name="name" class="form-control" value="<?= $task['name'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label><br>
            <input type="date" id="due_date" name="due_date" class="form-control" value="<?= $task['due_date'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label><br>
            <select id="status" name="status" class="form-control">
                    <option value="active" <?= $task['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
            </select>
        </div>

        <div class="d-grid">
            <input type="submit" class="btn btn-primary" value="Edit Task">
        </div>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>