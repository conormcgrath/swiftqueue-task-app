<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Create Task</title>
</head>

<body class="bg-light">
    
<div class="container mt-5">

	<div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Create Task</h2>

        <a href="/tasks" class="btn btn-outline-secondary btn-sm">Tasks</a>
    </div>
		
	<?php if (!empty($_SESSION['error'])): ?>
		<div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
		<?php unset($_SESSION['error']); ?>
	<?php endif; ?>

	<form method="POST" action="/tasks/create">

		<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

		<div class="mb-3">
			<label for="name" class="form-label">Task Name</label><br>
			<input type="text" id="name" name="name" class="form-control" required>
		</div>

		<div class="mb-3">
			<label for="due_date" class="form-label">Due Date</label><br>
			<input type="date" id="due_date" name="due_date" class="form-control" required>
		</div>
		
		<div class="mb-3">
			<label for="status" class="form-label">Status</label><br>
			<select id="status" name="status" class="form-control">
				<option value="active">Active</option>
				<option value="completed">Completed</option>
			</select>
		</div>
		
		<div class="d-grid">
            <input type="submit" class="btn btn-primary" value="Create Task">
        </div>

	</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>