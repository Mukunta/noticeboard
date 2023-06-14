<?php
session_start();

  // Check if the user is logged in
  if (!isset($_SESSION['username'])) {
    // Redirect to the login page or display an error message
    header('Location: login.php');
    exit();
  }
?>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "noticeboard";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve number of authors
$sqlAuthors = "SELECT COUNT(*) AS numAuthors FROM author";
$resultAuthors = $conn->query($sqlAuthors);
$numAuthors = 0;
if ($resultAuthors->num_rows > 0) {
    $rowAuthors = $resultAuthors->fetch_assoc();
    $numAuthors = $rowAuthors["numAuthors"];
}

// Retrieve number of posts
$sqlPosts = "SELECT COUNT(*) AS numPosts FROM posts";
$resultPosts = $conn->query($sqlPosts);
$numPosts = 0;
if ($resultPosts->num_rows > 0) {
    $rowPosts = $resultPosts->fetch_assoc();
    $numPosts = $rowPosts["numPosts"];
}

// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- Custom C -->
  <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
  <!-- Site Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><h2> Notice Board </h2></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto ">
            <li class="nav-item">
              <a class="nav-link mx-2 active" aria-current="page" href="../posts/get_posts.php">View Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-2" href="#manageposts">Manage Post</a>
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

  <div class="container">
    <h1 class="h1 mt-4">Welcome to the Blog Dashboard</h1>

    <!-- Simple Summaries -->
    <div class="row mt-4">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">Number of Posts</h3>
            <h1 class="card-text"> <?php echo $numPosts; ?> </h1>
            <p class="card-lead"><a href="create_post.php">Create A New Announcement</a></p>
            <!-- Additional statistics or graphs can be displayed here -->
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">Number of Authors:</h3>
            <h1 class="card-text"> <?php echo $numAuthors; ?></h1>
            <p class="card-lead">Click here to manage users</p>
            <!-- Additional content related to managing users -->
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-body">
          <h3 class="card-title">Important Announcements </h3>
            <h1 class="card-text"> <?php echo $numPosts; ?> </h1>
            <p class="card-lead">Manage Important Announcements </p>
            <!-- Additional content related to managing users -->
          </div>
        </div>
      </div>
    </div>

    <div>
      <h3 class="h2 mt-4" id="manageposts">Manage Posts</h3>
      <div class="container">
        
        <!-- Additional content related to managing posts -->
          <?php
          // Database connection and other necessary code here
          

          // Set pagination variables
          $perPage = 6; // Number of posts per page
          $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

          // Retrieve search query
          $search = isset($_GET['search']) ? $_GET['search'] : '';

          // Retrieve posts count based on search query and category
          $sqlCount = "SELECT COUNT(*) AS total FROM posts WHERE category LIKE '%$search%'";
          $resultCount = $conn->query($sqlCount);
          $rowCount = $resultCount->fetch_assoc();
          $totalPosts = $rowCount['total'];

          // Calculate total pages
          $totalPages = ceil($totalPosts / $perPage);

          // Calculate the offset for the SQL query
          $offset = ($page - 1) * $perPage;

          // Retrieve posts based on search query, category, and pagination
          $sqlPosts = "SELECT * FROM posts WHERE category LIKE '%$search%' ORDER BY date DESC LIMIT $offset, $perPage";
          $resultPosts = $conn->query($sqlPosts);

          // Check if there are posts
          if ($resultPosts->num_rows > 0) {
              while ($rowPosts = $resultPosts->fetch_assoc()) {
                  $postId = $rowPosts['id'];
                  $postTitle = $rowPosts['title'];
                  $postImage = $rowPosts['cover_photo'];
                  $postContent = $rowPosts['content'];
                  $filePath = '../images/';

                  // Display each post

                  echo '<div class="row mt-4 border rounded-2 p-3 shadow">
                          <div class="col">
                            <img src="'. $filePath . $postImage .'" alt="Post Thumbnail" class="img-thumbnail" width="150px">
                          </div>
                          <div class="col">
                            <div class="flex-grow-1 ms-3">
                              <h4>' . $postTitle . '</h4>
                              <p>' . substr($postContent, 0, 100) . '...</p>
      
                            </div>
                          </div>
                          <div class="col">
                            <div class="row">
                                <div class="col m-1"><a class="btn btn-primary" href="edit_post.php?id=' . $postId . '">Edit Post</a></div>
                                <div class="col m-1"><a class="btn btn-danger" href="delete_post.php?id=' . $postId . '">Delete Post</a></div>
                            </div>
                          </div>
                      </div>';

              }
          } else {
              echo 'No posts found.';
          }

          // Generate pagination links
          echo '<nav class="mt-4">
                  <ul class="pagination pagination-lg">';
          for ($i = 1; $i <= $totalPages; $i++) {
              echo '<li class="page-item"> <a class="page-link" href="dashboard.php?page=' . $i . '&search=' . $search . '">' . $i . '</a></li>';
          }
          echo '
                  </ul>
                </nav>';

          // Close database connection
          $conn->close();
          ?>

        </div>
    </div>

    <!-- end container -->
  </div>

  <!-- Footer -->
  <footer class="footer mt-4">
        <div class="container">
            <span>&copy; 2023 Your Company. All rights reserved.</span>
        </div>
  </footer>
  

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
 
