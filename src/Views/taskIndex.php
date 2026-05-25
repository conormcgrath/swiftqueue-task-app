<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>Tasks</title>
</head>

<body>

<a href="/logout">Log out</a>
    
<h2>Tasks</h2>

    <a href="/tasks/create">Create Task</a>

    <?php if (empty($tasks)): ?>

        <p>No tasks found.</p>

    <?php else: ?>
        <div x-data="{ filter: 'all' }">

            <div style="margin-bottom:20px;">

                <label for="filter">
                    Filter Tasks:
                </label>

                <select id="filter" x-model="filter">
                    <option value="all">All</option>
                    <option value="active">Active</option>
                    <option value="completed">Completed</option>
                </select>

            </div>

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

                    <tr x-show="filter === 'all' || filter === '<?= $task['status'] ?>'">

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
        </div>

    <?php endif; ?>

</body>

</html>