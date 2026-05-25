<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Edit Task</title>
</head>

<body>

<?php
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>
    
<h2>Edit Task</h2>
    
    <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="/tasks/update">

        <input type="hidden" name="id" value="<?= $task['id'] ?>">

		<label for="name">Task Name</label><br>
		<input type="text" id="name" name="name" value="<?= $task['name'] ?>" required><br><br>

		<label for="due_date">Due Date</label><br>
		<input type="date" id="due_date" name="due_date" value="<?= $task['due_date'] ?>" required><br><br>
        
		<label for="status">Status</label><br>
		<select id="status" name="status">
				<option value="active" <?= $task['status'] === 'active' ? 'selected' : '' ?>>Active</option>
				<option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
		</select><br><br>

        <button type="submit">Update Task</button>

    </form>

</body>

</html>