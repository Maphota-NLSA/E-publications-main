<?php
// Start session
session_start();

// Include database connection
include '../assets/php/conn.php';

// Include the header
include 'headerr.php';

// Initialize error message
$error_message = "";

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
                    header("Location: dashboard.php");
                    exit();
                } else {
                    // Invalid password
                    $error_message = "Invalid email or password.";
                }
            } else {
                // User not found
                $error_message = "Invalid email or password.";
            }

            // Close the statement
            $sql->close();
        } catch (Exception $e) {
            // Log error for debugging and display a generic error message
            error_log("Error during login: " . $e->getMessage());
            $error_message = "An error occurred. Please try again later.";
        }
    } else {
        $error_message = "Please fill in all fields.";
    }

    // Close the connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page - NLSA</title>

    <!-- Tab Icon -->
    <link href="../assets/img/favicon.webp" rel="icon">

    <!-- CSS & JS -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/login.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="logo-container text-center">
            <img src="../assets/img/NLSA-logo.png" class="logo-img" alt="NLSA Logo">
            <h1 class="system-heading">Electronic Publications</h1>
        </div>

        <div class="login-form-container d-flex flex-wrap justify-content-between align-items-center">
            <div class="side-left">
                <img src="../assets/img/photo 5.png" alt="Illustration" class="img-fluid">
            </div>
            <div class="side-right">
                <h4 class="text-center mb-4">Cataloguer Login</h4>
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger text-center">
                        <?= htmlspecialchars($error_message) ?>
                    </div>
                <?php endif; ?>
                <form class="sub-form" method="post" action="">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><ion-icon name="mail"></ion-icon></span>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <div class="mt-3"><a href="forgot_password.php" class="text-primary">Forgot Password?</a></div>
                    <button type="submit" class="button1 btn btn-primary mt-4 w-100">Login as Cataloguer</button>
                    <div class="mt-3 text-center">
                        <span>Don't have an account?</span> <a href="signup.php" class="text-primary">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
