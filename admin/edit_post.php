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
