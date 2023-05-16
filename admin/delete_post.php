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

    // Delete the post from the database
    $sql = "DELETE FROM posts WHERE id = $postId";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful, redirect to manage_posts.php
        header("Location: dashboard.php");
        exit();
    } else {
        // Error occurred during deletion
        echo "Error deleting post: " . $conn->error;
    }
} else {
    // No post ID provided, redirect to manage_posts.php
    header("Location: manage_posts.php");
    exit();
}

// Close database connection
$conn->close();
?>
