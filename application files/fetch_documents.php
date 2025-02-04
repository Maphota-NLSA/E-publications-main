<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'e-pubsdb'; // Using the first database
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]));
}

// Pagination variables
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = isset($_GET['limit']) ? max(1, (int)$_GET['limit']) : 10;
$offset = ($page - 1) * $limit;

// Get the search term
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

// Base URL for file paths
$baseUrl = "http://localhost/E-publications-main/uploads/";

// SQL query with pagination and optional search
$query = "SELECT 
            Book_ID AS id, 
            PublicationTitle AS title, 
            Genre AS description, 
            FileUpload AS file_path, 
            downloads AS download_count,
            PublisherEmail AS email,
            ISBN AS isbn
          FROM book_informationsheet";

if ($searchTerm !== '') {
    $query .= " WHERE PublicationTitle LIKE :search OR Genre LIKE :search";
}
$query .= " LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($query);

// Bind parameters
if ($searchTerm !== '') {
    $stmt->bindValue(':search', '%' . $searchTerm . '%', PDO::PARAM_STR);
}
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Update file paths
foreach ($documents as &$document) {
    $document['file_path'] = $document['file_path'] ? $baseUrl . $document['file_path'] : null;
}

// Get total record count for pagination
$countQuery = "SELECT COUNT(*) AS total FROM book_informationsheet";
if ($searchTerm !== '') {
    $countQuery .= " WHERE PublicationTitle LIKE :search OR Genre LIKE :search";
}
$countStmt = $pdo->prepare($countQuery);
if ($searchTerm !== '') {
    $countStmt->bindValue(':search', '%' . $searchTerm . '%', PDO::PARAM_STR);
}
$countStmt->execute();
$totalRecords = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

// Return JSON response
header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'documents' => $documents,
    'totalRecords' => $totalRecords,
    'totalPages' => ceil($totalRecords / $limit),
], JSON_UNESCAPED_SLASHES);
?>
