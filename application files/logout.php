<?php
// Start the session
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include '../assets/php/conn.php';

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// Handle logout POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sessionToken = $_SESSION['csrf_token'] ?? null; // Retrieve session token
    $postToken = $_POST['csrf_token'] ?? null;      // Retrieve posted token

    // Validate CSRF token
    if (!$sessionToken || !$postToken || !hash_equals($sessionToken, $postToken)) {
        http_response_code(403);
        die('Invalid CSRF token.');
    }

    try {
        // Log user logout event if user is logged in
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $stmt = $pdo->prepare("INSERT INTO logout_logs (user_id, logout_time) VALUES (?, NOW())");
            $stmt->execute([$userId]);
        }
    } catch (Exception $e) {
        error_log("Logout logging failed: " . $e->getMessage());
    }

    // Clear session and destroy
    session_unset();
    session_destroy();

    // Redirect to the welcome page
    header('Location: ../../application files/index.php?logout=success');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .logout-container {
            max-width: 400px;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #ffffff;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logout-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h1>Are you sure you want to log out?</h1>
        <form action="index.php" method="POST">
            <!-- CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
            <button type="submit">Logout</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
