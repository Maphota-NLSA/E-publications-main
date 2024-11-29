<?php
// Start session
session_start();

// Database connection parameters
include 'conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize user inputs
    $username = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input fields
    if (!empty($username) && !empty($password)) {
        try {
            // Prepare a SQL statement to prevent SQL injection
            $sql = $conn->prepare("SELECT * FROM users WHERE EmailAddress = ?");
            $sql->bind_param("s", $username);

            // Execute the query
            $sql->execute();
            $result = $sql->get_result();

            // Check if the user exists
            if ($result->num_rows > 0) {
                // Fetch the user record
                $user = $result->fetch_assoc();

                // Verify the password
                if (password_verify($password, $user['Password'])) {
                    // Password is correct, set session variables
                    $_SESSION['email'] = $username;

                    // Redirect to the catalog dashboard
                    header("Location: Login.php");
                    exit();
                } else {
                    // Invalid password
                    echo "Invalid email or password.";
                }
            } else {
                // User not found
                echo "Invalid email or password.";
            }

            // Close the statement
            $sql->close();
        } catch (Exception $e) {
            // Log error for debugging and display a generic error message
            error_log("Error during login: " . $e->getMessage());
            echo "An error occurred. Please try again later.";
        }
    } else {
        echo "Please fill in all fields.";
    }
}

// Close the connection
$conn->close();
?>
