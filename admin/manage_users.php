<?php
// Check if the user is logged in
// session_start();
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     header('Location: login.php');
//     exit;
// }

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

// Retrieve users from the database
$sqlUsers = "SELECT * FROM author";
$resultUsers = $conn->query($sqlUsers);

// Handle delete user functionality
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $sqlDelete = "DELETE FROM authors WHERE id = $deleteId";
    if ($conn->query($sqlDelete) === true) {
        echo "<script>alert('User deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting user');</script>";
    }
}

// Close the database connection
$conn->close();
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
              <a class="nav-link mx-2 " aria-current="page" href="../posts/get_posts.php">View Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-2" href="dashboard.php#manageposts">Manage Post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-2 active" href="manage_users.php">Manage Users</a>
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
        <h1 class="pt-4">Manage Users</h1>

        <h3>Users List</h3>
        <?php
        if ($resultUsers->num_rows > 0) {
            while ($row = $resultUsers->fetch_assoc()) {
                $userId = $row['id'];
                $userName = $row['name'];
                $userEmail = $row['email'];

                echo '<div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">' . $userName . '</h5>
                            <p class="card-text">' . $userEmail . '</p>
                            <a href="edit_user.php?id=' . $userId . '" class="btn btn-primary">Edit</a>
                            <a href="manage_users.php?delete_id=' . $userId . '" class="btn btn-danger">Delete</a>
                        </div>
                    </div>';
            }
        } else {
            echo '<p>No users found.</p>';
        }
        ?>

    </div>

    <!-- Footer -->
    <footer class="footer mt-4">
          <div class="container">
              <span>&copy; 2023 Your Company. All rights reserved.</span>
          </div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
