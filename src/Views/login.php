<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Task Manager Login</title>
</head>

<body class="bg-light">

    <div class="container mt-5">
        
        <h2 class="mb-4">Task Manager Login</h2>
            
        <form method="POST" action="/login">

            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <div class="mb-3">
                <label for="email" class="form-label">Email Address:</label>
                <input type="text" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <div class="d-grid">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>

        </form>
    
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>