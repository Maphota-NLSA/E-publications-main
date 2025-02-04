<?php
session_start();
include '../assets/php/conn.php'; // Database connection

// Check if the user is logged in
if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['User_ID'];
$profile = [];
$message = "";

try {
    // Fetch user details
    $stmt = $conn->prepare("SELECT FullName, EmailAddress, Contact FROM users WHERE User_ID = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $profile = $result->fetch_assoc();
    } else {
        $message = "User profile not found.";
    }
    $stmt->close();
} catch (Exception $e) {
    error_log("Error fetching profile: " . $e->getMessage());
    $message = "An error occurred while fetching your profile.";
}

// Handle profile updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['fullName']);
    $contact = trim($_POST['contact']);

    if (!empty($fullName) && !empty($contact)) {
        try {
            $updateStmt = $conn->prepare("UPDATE users SET FullName = ?, Contact = ? WHERE User_ID = ?");
            $updateStmt->bind_param("ssi", $fullName, $contact, $userId);

            if ($updateStmt->execute()) {
                $message = "Profile updated successfully!";
                $profile['FullName'] = $fullName;
                $profile['Contact'] = $contact;
            } else {
                $message = "Failed to update profile. Please try again.";
            }
            $updateStmt->close();
        } catch (Exception $e) {
            error_log("Error updating profile: " . $e->getMessage());
            $message = "An error occurred while updating your profile.";
        }
    } else {
        $message = "All fields are required.";
    }
}

$conn->close();
?>
