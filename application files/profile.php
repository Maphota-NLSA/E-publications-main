<?php
// Start session
session_start();

// Include database connection
include '../assets/php/conn.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Fetch user details from the database
$email = $_SESSION['email'];
$profile = [];
$message = "";

try {
    // Prepare SQL query to fetch user profile
    $sql = $conn->prepare("SELECT FullName, EmailAddress, ContactNumber FROM users WHERE EmailAddress = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $profile = $result->fetch_assoc();
    } else {
        $message = "Profile not found.";
    }

    $sql->close();
} catch (Exception $e) {
    error_log("Error fetching profile: " . $e->getMessage());
    $message = "An error occurred while loading your profile.";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['fullName']);
    $contact = trim($_POST['contact']);

    // Update user profile in the database
    if (!empty($fullName) && !empty($contact)) {
        try {
            $updateSql = $conn->prepare("UPDATE users SET FullName = ?, ContactNumber = ? WHERE EmailAddress = ?");
            $updateSql->bind_param("sss", $fullName, $contact, $email);

            if ($updateSql->execute()) {
                $message = "Profile updated successfully!";
                $profile['FullName'] = $fullName;
                $profile['ContactNumber'] = $contact;
            } else {
                $message = "Failed to update profile. Please try again.";
            }

            $updateSql->close();
        } catch (Exception $e) {
            error_log("Error updating profile: " . $e->getMessage());
            $message = "An error occurred while updating your profile.";
        }
    } else {
        $message = "All fields are required.";
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
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>


<body>
    
    <div class="container">
        <h2>Profile Details</h2>
        <?php if (!empty($message)): ?>
            <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <form action="profile.php" method="POST">
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" 
                       value="<?= htmlspecialchars($profile['FullName'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="<?= htmlspecialchars($profile['EmailAddress'] ?? '') ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contact" 
                       value="<?= htmlspecialchars($profile['ContactNumber'] ?? '') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
    
</body>

</html>
