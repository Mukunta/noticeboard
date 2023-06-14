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

// Check if the post ID is provided via GET request
if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    // Retrieve the post from the database
    $sql = "SELECT * FROM posts WHERE id = $postId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $postTitle = $row['title'];
        $postContent = $row['content'];
        // You can retrieve other post fields as needed
    } else {
        // Post not found, redirect to manage_posts.php
        header("Location: dashboard.php");
        exit();
    }
} else {
    // No post ID provided, redirect to manage_posts.php
    header("Location: dashboard.php");
    exit();
}

// Check if the form is submitted for updating the post
if (isset($_POST['submit'])) {
    $newTitle = $_POST['title'];
    $newContent = $_POST['content'];

    // Update the post in the database
    $sql = "UPDATE posts SET title = '$newTitle', content = '$newContent' WHERE id = $postId";

    if ($conn->query($sql) === TRUE) {
        // Update successful, redirect to manage_posts.php
        header("Location: dashboard.php");
        exit();
    } else {
        // Error occurred during update
        echo "Error updating post: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Post</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>

    <body>
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
        <div class="container">
            <h1>Edit Post</h1>

            <form method="POST" action="edit_post.php?id=<?php echo $postId; ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $postTitle; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="6" required><?php echo $postContent; ?></textarea>
                </div>
                <!-- Add other input fields as needed -->

                <button type="submit" name="submit" class="btn btn-primary">Update Post</button>
            </form>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>

</html>
