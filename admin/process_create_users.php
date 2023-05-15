<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the entered name, email, and password from the form
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Validate and sanitize the input if necessary

  // Database connection parameters
  $host = 'localhost';
  $dbUsername = 'root';
  $dbPassword = '';
  $dbName = 'noticeboard';

  // Create a new mysqli connection
  $mysqli = new mysqli($host, $dbUsername, $dbPassword, $dbName);

  // Check for connection errors
  if ($mysqli->connect_errno) {
    echo 'Failed to connect to the database: ' . $mysqli->connect_error;
    exit();
  }

  // Prepare the query to insert the user data into the authors table
  $query = "INSERT INTO author (name, email, password) VALUES (?, ?, ?)";
  $statement = $mysqli->prepare($query);

  // Hash the password for added security
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Bind the parameters
  $statement->bind_param('sss', $name, $email, $hashedPassword);

  // Execute the query
  if ($statement->execute()) {
    // Registration successful
    echo "<script>alert('Registration successful! You can now login.');</script>";
    header('Location: create_users.php');
  } else {
    // Registration failed
    echo "<script>alert('Registration failed. Please try again.');</script>";
    header('Location: create_users.php');
  }

  // Close the statement and the database connection
  $statement->close();
  $mysqli->close();
}
?>
