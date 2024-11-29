<?php
// Start the session
session_start();

// Include the database connection
require_once 'conn.php';

// Fetch the catalogues (duties) from the database
try {
    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT * FROM users ORDER BY date DESC");

    // Execute the query
    $stmt->execute();

    // Fetch the result set
    $result = $stmt->get_result();
    $catalogues = $result->fetch_all(MYSQLI_ASSOC);

} catch (Exception $e) {
    die("Error fetching catalogues: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue Notifications</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .notification-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 15px;
        }
        .notification-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }
        .notification-details {
            font-size: 1rem;
            color: #555;
        }
        .notification-date {
            font-size: 0.9rem;
            color: #888;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Catalogue Notifications</h1>

        <?php if (!empty($catalogues)): ?>
            <?php foreach ($catalogues as $catalogue): ?>
                <div class="notification-card">
                    <div class="notification-title">
                        <?php echo htmlspecialchars($catalogue['title']); ?>
                    </div>
                    <div class="notification-details">
                        <?php echo nl2br(htmlspecialchars($catalogue['details'])); ?>
                    </div>
                    <div class="notification-date">
                        Assigned on: <?php echo date('F j, Y, g:i a', strtotime($catalogue['date'])); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">No notifications available at the moment.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
