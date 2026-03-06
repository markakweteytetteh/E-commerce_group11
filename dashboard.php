<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
  header("Location: login.php");
  exit();
}

$message = "Welcome to your dashboard, " . htmlspecialchars($_SESSION["username"]) . "!";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
  $targetDir = "uploads/";
  if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
  }
  $fileName = basename($_FILES["fileToUpload"]["name"]);
  $fileName = preg_replace('/[^A-Za-z0-9_.-]/', '_', $fileName); // sanitize filename
  $uniqueName = uniqid() . '_' . $fileName;
  $targetFile = $targetDir . $uniqueName;

  //Validation: file type and size
  $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
  if ($_FILES["fileToUpload"]["size"] > 2097152) { // 2MB limit
    $message = "Sorry, your file is too large.";
  } elseif (!in_array($fileType, ["jpg", "jpeg", "png", "gif"])) {
    $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  } else {
    //Move uploaded file to target directory
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
      $message = "File uploaded successfully: " . htmlspecialchars($uniqueName);
    } else {
      $message = "Sorry, there was an error uploading your file.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!-- Header -->
  <header class="header">
    <div class="logo">
      <a href="index.php"><img src="https://img.icons8.com/ios-filled/50/000000/shopping-cart.png" alt="E-comm Logo"
          style="height:40px;vertical-align:middle;"> <span
          style="font-size:1.5em;font-weight:bold;vertical-align:middle;">E-comm</span></a>
    </div>
    <nav class="nav">
      <a href="index.php">Home</a>
      <a href="#">Shop</a>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </nav>
  </header>
  <!-- Banner -->
  <div class="banner" style="background:#f5f5f5;padding:20px;text-align:center;margin-bottom:20px;">
    <h1>Welcome to your Dashboard</h1>
    <p>Manage your account, upload products, and view your activity.</p>
  </div>
  <div class="container" style="max-width:700px;">
    <h2>Dashboard</h2>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></p>
    <div style="display:flex;flex-wrap:wrap;gap:32px;margin:32px 0;justify-content:center;">
      <div
        style="background:#f9f9fb;border-radius:8px;box-shadow:0 2px 8px #eee;padding:18px 28px;min-width:220px;text-align:center;">
        <h3>Upload Product Image</h3>
        <form method="POST" enctype="multipart/form-data">
          <input type="file" name="fileToUpload" required><br><br>
          <button type="submit">Upload</button>
        </form>
        <?php if (isset($message)): ?>
          <p style="color:blue;"> <?php echo $message; ?> </p>
        <?php endif; ?>
      </div>
      <div
        style="background:#f9f9fb;border-radius:8px;box-shadow:0 2px 8px #eee;padding:18px 28px;min-width:220px;text-align:center;">
        <h3>Account</h3>
        <p><b>Username:</b> <?php echo htmlspecialchars($_SESSION["username"]); ?></p>
        <a href="logout.php" class="btn" style="margin-top:12px;">Logout</a>
      </div>
    </div>
  </div>
  <div class="container" style="margin-top: 24px;">
    <h3>Your Uploaded Files</h3>
    <ul style="list-style: none; padding: 0;">
      <?php
      $files = array();
      $uploadsDir = "uploads/";
      if (is_dir($uploadsDir)) {
        $files = array_diff(scandir($uploadsDir), array('.', '..'));
      }
      if (empty($files)) {
        echo '<li style="color: #888;">No files uploaded yet.</li>';
      } else {
        foreach ($files as $file) {
          $fileUrl = htmlspecialchars($uploadsDir . $file);
          $fileNameDisplay = htmlspecialchars($file);
          echo "<li><a href='$fileUrl' target='_blank'>$fileNameDisplay</a></li>";
        }
      }
      ?>
    </ul>
  </div>
  <!-- Footer -->
  <footer class="footer" style="background:#222;color:#fff;text-align:center;padding:15px 0;margin-top:40px;">
    &copy; <?php echo date('Y'); ?> E-comm. All rights reserved.
  </footer>
</body>

</html>