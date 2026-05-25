<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Task Manager Login</title>
</head>

<body>
    
<h2>Task Manager Login</h2>
    
    <form method="POST" action="/login">
        
        <label for="email">Email Address:</label>
        <input type="text" name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>

</body>

</html>