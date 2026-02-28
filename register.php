<?php
session_start();

$error = $success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $confirm_password = trim($_POST["confirm_password"] ?? "");

    // Basic validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Store user info in session for demonstration
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
        $success = "Registration successful! You can now <a href='login.php'>login</a>.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <?php if ($error): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p style="color:blue;"><?php echo $success; ?></p>
        <?php endif; ?>
        <form method="POST" action="register.php">
            <label>Username:</label><br>
            <input type="text" name="username" required><br><br>
            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>
            <label>Confirm Password:</label><br>
            <input type="password" name="confirm_password" required><br><br>
            <button type="submit">Register</button>
            <button type="button" onclick="window.location.href='index.php'">Cancel</button>
        </form>
    </div>
</body>

</html>