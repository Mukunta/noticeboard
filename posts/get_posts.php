<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Blog</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
</head>

<body>
  <div class="container">
    <h1>Notice Board</h1>

    <div class="row">
      <div class="col-md-8">
        <div class="mb-4">
          <h2>Recent Posts</h2>
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

        // Fetch blog posts from the database
        $query = "SELECT * FROM posts ORDER BY date DESC";
        $result = $mysqli->query($query);

        if ($result) {
          while ($row = $result->fetch_assoc()) {
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

      </div>

      <div class="col-md-4">
        <!-- Sidebar content goes here -->
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</body>

</html>
