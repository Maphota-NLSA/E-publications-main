<?php
// Start session
session_start();
// Database connection parameters
include 'conn.php';

// // Create connection
// $conn = new mysqli($servername, $username, $password, $database);

// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
$username = $_POST['email'];
$password = $_POST['password'];
// Check if the form is submitted
if (trim($username)!=""and trim($password)!= "") {
    // Retrieve form data
 // Perform SQL query to check user credentials
    $sql = "SELECT * FROM admin WHERE username = '$username' AND Password = '$password'";
    $result = $conn->query($sql);
    
    // Check if user exists
    if ($result->num_rows > 0) {
        // User authenticated successfully, set session variables
        $_SESSION['email'] = $username;
        // Redirect to dashboard or desired page
        header("Location:../../application files/admin_dashboard.html");
        exit();
    } else {
        // Invalid credentials, display error message
        echo "Invalid email or password.";
    }
}

// Close connection
$conn->close();

