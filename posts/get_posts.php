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
  <div class="c">
    <div>
      <!-- <div class="col-md-8"> -->
      <div>

        <?php
        // Establish a database connection
        $mysqli = new mysqli('localhost', 'root', '', 'noticeboard');
        if ($mysqli->connect_errno) {
          // Handle database connection error
          echo 'Failed to connect to the database: ' . $mysqli->connect_error;
          exit;
        }

        // Fetch the four most important blog posts from the database
        // $importantQuery = "SELECT * FROM posts WHERE important = 1 ORDER BY created_at DESC LIMIT 4";
        $importantQuery = "SELECT * FROM posts WHERE important = 1 ORDER BY date DESC LIMIT 4";
        $importantResult = $mysqli->query($importantQuery);

        // file path for the images
        $filePath = '../images/';

        // header section with important posts
        echo '<div class="post-grid">';

        if ($importantResult) {
          while ($row = $importantResult->fetch_assoc()) {
            // Display the important posts

            ?>
            <div class="post-card">
              <div class="card-body">
                <img src="<?php echo $filePath . $row['cover_photo']; ?>" alt="Post Thumbnail" class="post-image">
                <h3 class="card-title"><?= $row['title'] ?></h3>

                <p class="card-text"><?= substr($row['content'], 0, 100); ?> <a href="view_posts.php?id=<?= $row['id'] ?>">...[Read More]</a></p>
                <p class="card-text"><small class="text-muted">Category: <?= $row['category'] ?></small></p>
                <p class="card-text"><small class="text-muted">Posted on: <?= $row['date'] ?></small></p>
              </div>
            </div>

          <?php
          }
        } else {
          // Handle query error
          echo 'Failed to fetch important blog posts: ' . $mysqli->error;
        }

        echo '</div>';
        // end header section with important posts

        // Calculate pagination parameters
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $postsPerPage = 10;
        $offset = ($currentPage - 1) * $postsPerPage;

        // Fetch the remaining posts for pagination
        // $remainingQuery = "SELECT * FROM posts WHERE important = 0 ORDER BY created_at DESC LIMIT $offset, $postsPerPage";
        $remainingQuery = "SELECT * FROM posts WHERE important = 0 ORDER BY date DESC LIMIT $offset, $postsPerPage";
        $remainingResult = $mysqli->query($remainingQuery);

        if ($remainingResult) {
          while ($row = $remainingResult->fetch_assoc()) {
            // Display the remaining posts
            ?>
            <div class="container m-4">
              <div class="row ">
                <div class="col">
                  <img src="<?php echo $filePath . $row['cover_photo']; ?>" alt="Post Thumbnail" class="img-thumbnail">
                </div>
                <div class="col-9">
                  <h3 class="card-title"><?= $row['title'] ?></h3>
                  <p class="card-text"><?= substr($row['content'], 0, 100); ?> <a href="view_posts.php?id=<?= $row['id'] ?>">...[Read More]</a></p>
                  <p class="card-text"><small class="text-muted">Category: <?= $row['category'] ?></small></p>
                  <p class="card-text"><small class="text-muted">Posted on: <?= $row['date'] ?></small></p>
                </div>
              </div>
            </div>
          <?php
          }

          

        } else {
          // Handle query error
          echo 'Failed to fetch blog posts: ' . $mysqli->error;
        }

        // Close the database connection
        $mysqli->close();
        ?>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <?php

            $mysqli = new mysqli('localhost', 'root', '', 'noticeboard');
            if ($mysqli->connect_errno) {
              // Handle database connection error
              echo 'Failed to connect to the database: ' . $mysqli->connect_error;
              exit;
            }
            // Calculate the total number of pages
            $totalPostsQuery = "SELECT COUNT(*) as total FROM posts WHERE important = 0";
            $totalPostsResult = $mysqli->query($totalPostsQuery);
            $totalPosts = $totalPostsResult->fetch_assoc()['total'];
            $totalPages = ceil($totalPosts / $postsPerPage);

            // Display pagination links
            for ($i = 1; $i <= $totalPages; $i++) {
              ?>
              <li class="page-item <?php if ($i == $currentPage) echo 'active' ?>">
                <a class="page-link" href="get_posts2.php?page=<?= $i ?>"><?= $i ?></a>
              </li>
            
            <?php
            $mysqli->close();
            }
            ?>
          </ul>
        </nav>
      </div>
    </div>
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
