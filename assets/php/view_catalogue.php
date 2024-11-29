<?php
// Ensure strict types for better type safety
declare(strict_types=1);

require_once 'conn.php';

// Validate the 'id' parameter
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400); // Bad Request
    die('Invalid request');
}

$id = (int)$_GET['id'];

// Prepare and execute the SQL query securely
try {
    $stmt = $conn->prepare("SELECT * FROM catalogues WHERE id = :id");
    if (!$stmt) {
        throw new Exception('Failed to prepare statement');
    }
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $catalogue = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$catalogue) {
        http_response_code(404); // Not Found
        die('Catalogue not found');
    }
} catch (PDOException $e) {
    // Log the error for debugging purposes
    error_log("Database error: " . $e->getMessage());
    http_response_code(500); // Internal Server Error
    die('An unexpected error occurred. Please try again later.');
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    http_response_code(500); // Internal Server Error
    die('An unexpected error occurred. Please try again later.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catalogue Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-4">
    <h1><?php echo htmlspecialchars($catalogue['title']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($catalogue['description'])); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($catalogue['status']); ?></p>
    <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
