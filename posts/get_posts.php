<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Blog</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h1>Notice Board</h1>

    <div class="row">
      <div class="col-md-8">
        <div class="mb-4">
          <h2>Important Posts</h2>
          <hr>
        </div>

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

        if ($importantResult) {
          while ($row = $importantResult->fetch_assoc()) {
            // Display the important posts
            ?>
            <div class="card mb-4">
              <div class="card-body">
                <h3 class="card-title"><?= $row['title'] ?></h3>
                <p class="card-text"><?= $row['content'] ?></p>
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
            <div class="card mb-4">
              <div class="card-body">
                <h3 class="card-title"><?= $row['title'] ?></h3>
                <p class="card-text"><?= $row['content'] ?></p>
                <p class="card-text"><small class="text-muted">Category: <?= $row['category'] ?></small></p>
                <p class="card-text"><small class="text-muted">Posted on: <?= $row['date'] ?></small></p>
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

      <div class="col-md-4">
        <!-- Sidebar content goes here -->
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
