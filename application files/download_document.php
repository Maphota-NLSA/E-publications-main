<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-pubsdb";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]));
}

// Validate and sanitize the Book_ID parameter
if (!isset($_GET['Book_ID']) || !is_numeric($_GET['Book_ID'])) {
    die(json_encode(['success' => false, 'message' => 'Invalid Book ID.']));
}

$bookId = (int)$_GET['Book_ID'];

// Fetch the file path
$query = "SELECT FileUpload AS file_path FROM book_informationsheet WHERE Book_ID = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $bookId, PDO::PARAM_INT);
$stmt->execute();
$document = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$document || empty($document['file_path'])) {
    die(json_encode(['success' => false, 'message' => 'File not found.']));
}

$filePath = __DIR__ . "../uploads/" . $document['file_path']; // Adjust path whenever switching device or storage

if (!file_exists($filePath)) {
    die(json_encode(['success' => false, 'message' => 'File does not exist on the server.']));
}

// Increment download count
$updateQuery = "UPDATE book_informationsheet SET downloads = downloads + 1 WHERE Book_ID = :id";
$updateStmt = $pdo->prepare($updateQuery);
$updateStmt->bindParam(':id', $bookId, PDO::PARAM_INT);
$updateStmt->execute();

// Send the file for download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));
readfile($filePath);
exit;
?>
