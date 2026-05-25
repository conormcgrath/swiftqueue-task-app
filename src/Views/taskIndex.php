<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Tasks</title>
</head>

<body>
    
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

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</body>

</html>