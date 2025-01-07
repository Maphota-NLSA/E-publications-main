<?php
// Database connection
$host = 'localhost';
$dbname = 'e-pubsdb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Validate POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Book_ID'], $_POST['status'])) {
    $bookId = $_POST['Book_ID'];
    $status = $_POST['status'];

    // Update the status
    $query = "UPDATE book_informationsheet SET status = :status WHERE Book_ID = :bookId";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':status', $status, PDO::PARAM_STR);
    $stmt->bindValue(':bookId', $bookId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: view.php'); // Redirect back to the view page
        exit;
    } else {
        echo "Error updating status.";
    }
} else {
    echo "Invalid request.";
}
?>
