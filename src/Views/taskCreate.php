<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Create Task</title>
</head>

<body>
    
<h2>Create Task</h2>
    
    <form method="POST" action="/tasks/create">

        <label for="name">Task Name</label><br>
		<input type="text" id="name" name="name" required><br><br>

		<label for="due_date">Due Date</label><br>
		<input type="date" id="due_date" name="due_date" required><br><br>
        
		<label for="status">Status</label><br>
		<select id="status" name="status">
				<option value="active">Active</option>
				<option value="completed">Completed</option>
		</select><br><br>

        <button type="submit">Create Task</button>

    </form>

</body>

</html>