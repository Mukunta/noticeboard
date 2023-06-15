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

// Check if the user ID is provided via GET request
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Retrieve the user from the database
    $sql = "SELECT * FROM author WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userName = $row['name'];
        $userEmail = $row['email'];
        // You can retrieve other user fields as needed
    } else {
        // User not found, redirect to manage_users.php
        header("Location: manage_users.php");
        exit();
    }
} else {
    // No user ID provided, redirect to manage_users.php
    header("Location: manage_users.php");
    exit();
}

// Check if the form is submitted for updating the user
if (isset($_POST['submit'])) {
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];

    // Update the user in the database
    $sql = "UPDATE author SET name = '$newUsername', email = '$newEmail' WHERE id = '$userId'";

    if ($conn->query($sql) === TRUE) {
        // Update successful, redirect to manage_users.php
        header("Location: manage_users.php");
        exit();
    } else {
        // Error occurred during update
        echo "Error updating user: " . $conn->error;
    }
}

// Check if the form is submitted for deleting the user
if (isset($_POST['delete'])) {
    // Delete the user from the database
    $sql = "DELETE FROM users WHERE id = '$userId'";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful, redirect to manage_users.php
        header("Location: manage_users.php");
        exit();
    } else {
        // Error occurred during deletion
        echo "Error deleting user: " . $conn->error;
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
    <title>Edit User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Edit User</h1>

        <form method="POST" action="edit_user.php?id=<?php echo $userId; ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $userName; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $userEmail; ?>" required>
            </div>
            <!-- Add other input fields as needed -->

            <button type="submit" name="submit" class="btn btn-primary">Update User</button>
            <button type="submit" name="delete" class="btn btn-danger">Delete User</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
