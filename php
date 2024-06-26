<?php
// Database connection settings
$host = 'localhost'; // MySQL host
$db = 'project_botique'; // Database name
$user = 'username'; // Database username
$pass = 'password'; // Database password

// Establish MySQL database connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to retrieve user credentials
    $stmt = $mysqli->prepare('SELECT * FROM data WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, login successful
            echo 'Login successful!';
            // Redirect to dashboard or perform further actions
            exit;
        } else {
            // Invalid password
            echo 'Invalid password.';
        }
    } else {
        // User not found
        echo 'User not found.';
    }

    $stmt->close();
}

$mysqli->close();
?>
