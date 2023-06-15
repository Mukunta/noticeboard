<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Blog</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
  <!-- navbar start -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><h2> Notice Board </h2></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto ">
            <li class="nav-item">
              <a class="nav-link mx-2 active" aria-current="page" href="get_posts.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-2" href="#manageposts"><!--Put Link Filter Link--></a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-2" href="manage_users.php"><!--Put Link Filter Link--></a>
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
              <a class="nav-link text-light h5" href="../admin/login.php" target="blank"><span class="material-icons md-48">login</span></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- navbar end -->

    <!-- Main Content -->
    <div class="container mt-4">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "noticeboard";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if post ID is provided via GET request
        if (!isset($_GET['id'])) {
            header("Location: ../index.php"); // Redirect to home page if no post ID is provided
            exit();
        }

        // Retrieve the post ID from the GET request
        $postId = $_GET['id'];

        // Retrieve the post from the database
        $sql = "SELECT * FROM posts WHERE id = $postId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Post found, display the post content
            $row = $result->fetch_assoc();
            $postTitle = $row['title'];
            $postContent = $row['content'];
            $postImage = $row['cover_photo'];

            // Display the post with Bootstrap styles
            echo '<div class="post-container">';
            echo "<h1 class='mt-4'>$postTitle</h1>";
            echo "<img src='../images/$postImage' alt='Post Image' class='img-fluid rounded mb-4'>";
            echo "<p class='lead'>$postContent</p>";
            echo '</div>';
        } else {
            // Post not found, display error message
            echo "Post not found.";
        }

        // Close database connection
        $conn->close();
        ?>
    </div>

      <!-- footer -->
  <footer class="footer mt-4">
        <div class="container">
            <span>&copy; 2023 Your Company. All rights reserved.</span>
        </div>
  </footer>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
