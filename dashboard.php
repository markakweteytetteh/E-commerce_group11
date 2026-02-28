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
  <div class="container">
    <h2>Dashboard</h2>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></p>
    <a href="logout.php">Logout</a>

    <h3>Upload a File</h3>
    <?php if ($message): ?>
      <p style="color: blue;"><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="dashboard.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="fileToUpload" required>
      <button type="submit">Upload</button>
    </form>
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
</body>

</html>