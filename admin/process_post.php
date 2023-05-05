<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $author = $_POST['author'];

    // Validate form data (you can add more validation as per your requirements)
    if (empty($title) || empty($content) || empty($category)) {
        // Handle validation errors
        echo 'Please fill in all the required fields.';
        exit;
    }

    // Process the data and create a new blog post
    // You can write the necessary code here to insert the data into your database or perform any other actions

    // Example: Inserting data into the database using MySQLi
    $mysqli = new mysqli('localhost', 'root', '', 'noticeboard');
    if ($mysqli->connect_errno) {
        // Handle database connection error
        echo 'Failed to connect to the database: ' . $mysqli->connect_error;
        exit;
    }

    // Prepare and execute the SQL query
    $query = "INSERT INTO posts (title, content, category, author) VALUES (?, ?, ?, ?)";
    $statement = $mysqli->prepare($query);
    $statement->bind_param('ssss', $title, $content, $category, $author);
    if (!$statement->execute()) {
        // Handle query execution error
        echo 'Failed to create the blog post: ' . $statement->error;
        exit;
    }

    // Close the database connection
    $statement->close();
    $mysqli->close();

    // Display the created blog post is successfully created
    echo "<script>alert('Blog post created successfully!');</script>";
    exit;
}
