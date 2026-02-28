<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and trim input (sanitize only for output)
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // For demonstration, check against session values set in register.php
    if (isset($_SESSION["username"]) && isset($_SESSION["email"]) && isset($_SESSION["password"])) {
        // Simple condition check (in real projects, check against database and use password hashing)
        if ($username === $_SESSION["username"] && $password === $_SESSION["password"]) {
            // Login successful - redirect to dashboard
            $_SESSION["logged_in"] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "No registered user found! Please register first. <a href='register.php'>Register</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <?php if ($error): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <label>Username:</label><br>
            <input type="text" name="username" required><br><br>

            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>

            <button type="submit">Login</button>
            <button type="button" onclick="window.location.href='index.php'">Cancel</button>
        </form>
    </div>
</body>

</html>