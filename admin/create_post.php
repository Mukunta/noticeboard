<?php
  session_start();

  // Check if the user is logged in
  if (!isset($_SESSION['username'])) {
    // Redirect to the login page or display an error message
    header('Location: login.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Post</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h1>Create Post</h1>
    <form action="process_post.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="author" value="1">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" id="category" name="category" required>
          <option value="">Select a category</option>
          <option value="staff">Staff</option>
          <option value="students">Students</option>
          <option value="general">General</option>
          <!-- Add more options as needed -->
        </select>
      </div>
      <div class="mb-3">
            <label for="cover_photo" class="form-label">Cover Photo</label>
            <input type="file" class="form-control" id="cover_photo" name="cover_photo" required accept="image/*">
      </div>
      <button type="submit" class="btn btn-primary">Create</button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</body>

</html>
