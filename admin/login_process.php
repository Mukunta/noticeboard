<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the entered username and password from the form
  $username = $_POST['username'];
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

  // Prepare the query to retrieve the authors hashed password
  $query = "SELECT password FROM author WHERE name = ?";
  $statement = $mysqli->prepare($query);

  // Bind the username parameter
  $statement->bind_param('s', $username);

  // Execute the query
  $statement->execute();

  // Get the result
  $result = $statement->get_result();

  // Check if the username exists
  if ($result->num_rows === 1) {
    // Fetch the hashed password from the result
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password'];

    // Verify the entered password with the hashed password
    if (password_verify($password, $hashedPassword)) {
      // Password is correct
      $_SESSION['username'] = $username;
      // Store other relevant user information in session variables

      // Redirect the user to the desired page
      header('Location: dashboard.php');
      exit();
    }
  }

  // If the login is unsuccessful, display an error message or redirect to a login error page
  echo 'Invalid username or password';

  // Close the statement and the database connection
  $statement->close();
  $mysqli->close();
}
?>
