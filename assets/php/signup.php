<?php
session_start();
include 'conn.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
    $email_address = isset($_POST['email_address']) ? trim($_POST['email_address']) : '';
    $contact = isset($_POST['contact']) ? trim($_POST['contact']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($fullname) || empty($email_address) || empty($contact) || empty($password)) {
        echo "Please ensure that all fields are filled.";
        exit;
    }

    // Attempt to move the uploaded file
    if ($conn && $conn->ping()) {
        $password = md5('password');
        $stmt = $conn->prepare("INSERT INTO users(FullName, EmailAddress, Contact, Password)
                    VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullname, $email_address, $contact, $password);

        if ($stmt->execute()) {
            $_SESSION['status'] = "You registered successfully!";
            header("Location:../../application files/signup.php");
        } else {
            echo "Database error: " . $conn->error; 
        }

        $stmt->close();
    } else {
        echo "Database connection error.";
    }
} else {
    echo "File upload error: Unable to move file.";
}
