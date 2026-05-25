<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Tasks</title>
</head>

<body>

<a href="/logout">Log out</a>
    
<h2>Tasks</h2>
    
    <?php if (empty($tasks)): ?>

        <p>No tasks found.</p>

    <?php else: ?>

        <table>

            <thead>

                <tr>
                    <th>Name</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>

            </thead>

            <tbody>

            <?php foreach ($tasks as $task): ?>

                <tr>

                    <td>
                        <?= $task['name'] ?>
                    </td>

                    <td>
                        <?= $task['due_date'] ?>
                    </td>

                    <td>
                        <?= $task['status'] ?>
                    </td>

                    <td>
                        <a href="/tasks/update?id=<?= $task['id'] ?>">Edit</a>

                        <form 
                            method="POST" 
                            action="/tasks/delete" 
                            style="display:inline;"
                            onsubmit="return confirm('Are you sure you want to delete this task?');">
                            <input 
                                type="hidden" 
                                name="id" 
                                value="<?= htmlspecialchars($task['id']) ?>"
                            >

                            <button type="submit">
                                Delete
                            </button>
                        </form>
                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</body>

</html>