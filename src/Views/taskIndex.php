<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>Tasks</title>
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Tasks</h2>

        <a href="/logout" class="btn btn-outline-secondary btn-sm">Log out</a>
    </div>

    <div class="mb-4">
        <a href="/tasks/create" class="btn btn-primary">Create Task</a>
    </div>

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

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">

                    <thead>

                        <tr>
                            <th>Name</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
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
                                <?= ucfirst($task['status']) ?>
                            </td>

                            <td>
                                <a href="/tasks/update?id=<?= $task['id'] ?>" class="btn btn-sm btn-warning">Edit</a>

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

                                    <button class="btn btn-sm btn-danger" type="submit">
                                        Delete
                                    </button>
                                </form>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>
            </div>
        </div>

    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</div>

</body>

</html>