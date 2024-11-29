<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sessionToken = $_SESSION['csrf_token'] ?? null; // Safely retrieve session token
    $postToken = $_POST['csrf_token'] ?? null;      // Safely retrieve posted token

    error_log("Session Token: " . ($sessionToken ?: 'Not set'));
    error_log("Post Token: " . ($postToken ?: 'Not set'));

    if (!$sessionToken || !$postToken || !hash_equals($sessionToken, $postToken)) {
        http_response_code(403);
        die('Invalid CSRF token.');
    }
}

include 'conn.php';

try {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $stmt = $conn->prepare("INSERT INTO logout_logs (user_id, logout_time) VALUES (?, NOW())");
        $stmt->execute([$userId]);
    }
} catch (PDOException $e) {
    error_log("Logout logging failed: " . $e->getMessage());
}

// Clear session data and destroy session
session_unset();
session_destroy();

// Redirect to the welcome page
header('Location: ../../application files/index.html?logout=success');
exit();
?>
