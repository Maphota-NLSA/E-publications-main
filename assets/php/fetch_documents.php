<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-pubsdb";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// Pagination variables
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = isset($_GET['limit']) ? max(1, (int)$_GET['limit']) : 10;
$offset = ($page - 1) * $limit;

// SQL query to fetch document information
$sql = "SELECT 
            Book_ID AS id, 
            PublicationTitle AS title, 
            Genre AS description, 
            FileUpload AS file_path, 
            downloads AS download_count 
        FROM book_informationsheet
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

// Handle SQL errors
if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Database query failed: ' . $conn->error]);
    $conn->close();
    exit;
}

// Prepare document data
$documents = [];
$baseUrl = "http://localhost/uploads/"; // Replace with your server URL
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Generate a relative or absolute URL for the file path
        $row['file_path'] = $row['file_path'] ? $baseUrl . $row['file_path'] : null;
        $documents[] = $row;
    }
}

// Count total records for pagination
$totalQuery = "SELECT COUNT(*) as total FROM book_informationsheet";
$totalResult = $conn->query($totalQuery);
$totalRecords = $totalResult->fetch_assoc()['total'];

// Return JSON response with document data
header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'documents' => $documents,
    'totalRecords' => $totalRecords,
    'totalPages' => ceil($totalRecords / $limit)
], JSON_UNESCAPED_SLASHES);

$conn->close();
?>
