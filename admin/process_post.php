<?php
// Retrieve form data
$title = $_POST['title'];
$content = $_POST['content'];
$category = $_POST['category'];
$author = $_POST['author'];

// Handle image upload
$targetDirectory = "../images/"; // Set the target directory where the image will be stored
$targetFile = $targetDirectory . basename($_FILES['cover_photo']['name']);

// Check if the file was uploaded without errors
if ($_FILES['cover_photo']['error'] === UPLOAD_ERR_OK) {
  // Generate a unique filename to avoid overwriting existing files
  $file_name = uniqid() . '_' . $_FILES['cover_photo']['name'];

  // Move the uploaded file to the target directory
  if (move_uploaded_file($_FILES['cover_photo']['tmp_name'], $targetDirectory . $file_name)) {
    // File upload success
    // Save the post details and the file name in the database
    // Insert the post data into the database

    // Establish a database connection
    $mysqli = new mysqli('localhost', 'root', '', 'noticeboard');
    if ($mysqli->connect_errno) {
      // Handle database connection error
      echo 'Failed to connect to the database: ' . $mysqli->connect_error;
      exit;
    }

    // Prepare the SQL statement to insert the post data
    $query = "INSERT INTO posts (title, content, category, author, cover_photo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssss", $title, $content, $category, $author, $file_name);
    
    // Execute the statement
    if ($stmt->execute()) {
      // Post creation success
      echo "<script>alert('Post created successfully!');</script>";
      header("Location: http://localhost/noticeboard/admin/create_post.php");
      echo "<script>alert('Post created successfully!');</script>";
      exit;
    } else {
      // Handle query error
      echo "<script>alert('Blog post created successfully!');</script>";
      header("Location: http://localhost/noticeboard/admin/create_post.php");
    }

    // Close the statement and database connection
    $stmt->close();
    $mysqli->close();
  } else {
    // File upload failed
    echo 'Failed to upload the file.';
  }
} else {
  // Handle file upload error
  echo 'File upload error: ' . $_FILES['cover_photo']['error'];
}
