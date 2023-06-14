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
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><h2> Notice Board </h2></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto ">
          <li class="nav-item">
            <a class="nav-link mx-2 active" aria-current="page" href="../posts/get_posts.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="#manageposts">Manage Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="manage_users.php">Manage Users</a>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Company
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">Blog</a></li>
              <li><a class="dropdown-item" href="#">About Us</a></li>
              <li><a class="dropdown-item" href="#">Contact us</a></li>
            </ul>
          </li> -->
        </ul>
        <ul class="navbar-nav ms-auto d-none d-lg-inline-flex">
          <li class="nav-item mx-2">
            <a class="nav-link text-light h5" href="" target="blank"><i class="fab fa-google-plus-square"></i></a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link text-light h5" href="" target="blank"><i class="fab fa-twitter"></i></a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link text-light h5" href="" target="blank"><i class="fab fa-facebook-square"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- navbar end -->

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
