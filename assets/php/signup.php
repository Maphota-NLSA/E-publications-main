<?php
// Include database connection
include 'conn.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Redirect to signup form if accessed without POST
    header("Location: ../../application files/signup.html");
    exit;
}

try {
    // Sanitize and retrieve form inputs
    $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
    $email_address = isset($_POST['email_address']) ? trim($_POST['email_address']) : '';
    $contact = isset($_POST['contact']) ? trim($_POST['contact']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

    // Validate input
    if (empty($fullname) || empty($email_address) || empty($contact) || empty($password) || empty($confirm_password)) {
        echo "Please fill in all fields.";
        exit;
    }

    if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Check if email already exists
    $checkStmt = $conn->prepare("SELECT User_ID FROM users WHERE EmailAddress = ?");
    if (!$checkStmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    $checkStmt->bind_param("s", $email_address);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "Email is already registered.";
        exit;
    }
    $checkStmt->close();

    // Insert new user into the database
    $stmt = $conn->prepare("INSERT INTO users (FullName, EmailAddress, Contact, Password) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ssss", $fullname, $email_address, $contact, $password_hash);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: welcome.php");
        exit;
    } else {
        echo "Database error: " . $stmt->error;
    }
    $stmt->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>
