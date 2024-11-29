<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-pubsdb";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// Validate that Book_ID is provided in the GET request
if (!isset($_GET['Book_ID'])) {
    echo json_encode(['success' => false, 'message' => 'Book_ID parameter is missing.']);
    $conn->close();
    exit;
}

// Sanitize and validate Book_ID
$id = intval($_GET['Book_ID']);
if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid Book_ID parameter.']);
    $conn->close();
    exit;
}

// Fetch the file path from the database
$sql = "SELECT FileUpload AS file_path FROM book_informationsheet WHERE Book_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $file_path = "../../uploads/" . $row['file_path'];

    // Check if the file exists
    if (!file_exists($file_path)) {
        echo json_encode(['success' => false, 'message' => 'File not found on the server.']);
        $conn->close();
        exit;
    }

    // Increment download count
    $update_sql = "UPDATE book_informationsheet SET downloads = downloads + 1 WHERE Book_ID = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("i", $id);
    $update_stmt->execute();

    echo json_encode(['success' => true, 'file_path' => $file_path]);
} else {
    echo json_encode(['success' => false, 'message' => 'Book not found in the database.']);
}

$stmt->close();
$conn->close();
?>
