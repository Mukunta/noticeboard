<?php
// Database connection and other necessary code here

// Check if post ID is provided via GET request
if (!isset($_GET['id'])) {
    header("Location: index.php"); // Redirect to home page if no post ID is provided
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
    echo '<div class="container">';
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
