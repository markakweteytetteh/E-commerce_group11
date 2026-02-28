<?php
//Start session for traucking user login state.
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce website</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Welcome to E-comm</h2>
        <?php if (isset($_GET['logout']) && $_GET['logout'] == 1): ?>
            <p style="color:blue;">You have been logged out.</p>
        <?php endif; ?>
        <!-- Add your homepage content here -->
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</body>

</html>