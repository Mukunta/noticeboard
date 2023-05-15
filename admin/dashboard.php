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
</head>

<body>
  <div class="container">
    <h1>Welcome to the Blog Dashboard</h1>

    <!-- Navigation Menu -->
    <ul class="nav">
      <li class="nav-item"><a class="nav-link" href="manage_posts.php">Manage Posts</a></li>
      <li class="nav-item"><a class="nav-link" href="manage_users.php">Manage Users</a></li>
      <li class="nav-item"><a class="nav-link" href="statistics.php">Statistics</a></li>
      <li class="nav-item"><a class="nav-link" href="index.php">Go to Site</a></li>
      <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
    </ul>

    <div class="row mt-4">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Statistics</h5>
            <p class="card-text">Number of Authors: <?php echo $numAuthors; ?></p>
            <p class="card-text">Number of Posts: <?php echo $numPosts; ?></p>
            <!-- Additional statistics or graphs can be displayed here -->
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage Users</h5>
            <p class="card-text">Click here to manage users</p>
            <!-- Additional content related to managing users -->
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col">
        <h3>Manage Posts</h3>
        <!-- Additional content related to managing posts -->
          <?php
          // Database connection and other necessary code here
          

          // Set pagination variables
          $perPage = 10; // Number of posts per page
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
          $sqlPosts = "SELECT * FROM posts WHERE category LIKE '%$search%' ORDER BY created_at DESC LIMIT $offset, $perPage";
          $resultPosts = $conn->query($sqlPosts);

          // Check if there are posts
          if ($resultPosts->num_rows > 0) {
              while ($rowPosts = $resultPosts->fetch_assoc()) {
                  $postId = $rowPosts['id'];
                  $postTitle = $rowPosts['title'];
                  $postImage = $rowPosts['image'];
                  $postContent = $rowPosts['content'];

                  // Display each post
                  echo '<div class="post">
                          <img src="' . $postImage . '" alt="Post Thumbnail">
                          <h4>' . $postTitle . '</h4>
                          <p>' . substr($postContent, 0, 100) . '...</p>
                          <a href="edit_post.php?id=' . $postId . '">Edit</a>
                          <a href="delete_post.php?id=' . $postId . '">Delete</a>
                        </div>';
              }
          } else {
              echo 'No posts found.';
          }

          // Generate pagination links
          echo '<div class="pagination">';
          for ($i = 1; $i <= $totalPages; $i++) {
              echo '<a href="manage_posts.php?page=' . $i . '&search=' . $search . '">' . $i . '</a>';
          }
          echo '</div>';

          // Close database connection and other necessary code here
          $conn->close();
          ?>

      </div>
    </div>

    <!-- end container -->
  </div>
  

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
 
