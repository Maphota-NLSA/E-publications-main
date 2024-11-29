<?php
// Start session
session_start();

// Database connection parameters
include 'conn.php';

// Retrieve form data
$username = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Pagination variables
$limit = 5; // Number of notifications per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Filters
$type = isset($_GET['type']) ? $_GET['type'] : 'all';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';

try {
    // Base query
    $query = "SELECT * FROM notifications WHERE 1=1";
    if ($type !== 'all') $query .= " AND type = ?";
    if (!empty($search)) $query .= " AND (title LIKE ? OR description LIKE ?)";
    if (!empty($date)) $query .= " AND date = ?";
    $query .= " ORDER BY date DESC LIMIT ? OFFSET ?";

    $stmt = $conn->prepare($query);

    // Bind parameters
    $paramIndex = 1;
    if ($type !== 'all') $stmt->bind_param('s', $type);
    if (!empty($search)) {
        $likeSearch = "%$search%";
        $stmt->bind_param('ss', $likeSearch, $likeSearch);
    }
    if (!empty($date)) $stmt->bind_param('s', $date);
    $stmt->bind_param('ii', $limit, $offset);

    // Execute and fetch data
    $stmt->execute();
    $result = $stmt->get_result();
    $notifications = $result->fetch_all(MYSQLI_ASSOC);

    // Get total notifications count for pagination
    $countQuery = "SELECT COUNT(*) as total FROM notifications WHERE 1=1";
    if ($type !== 'all') $countQuery .= " AND type = ?";
    if (!empty($search)) $countQuery .= " AND (title LIKE ? OR description LIKE ?)";
    if (!empty($date)) $countQuery .= " AND date = ?";

    $countStmt = $conn->prepare($countQuery);
    if ($type !== 'all') $countStmt->bind_param('s', $type);
    if (!empty($search)) $countStmt->bind_param('ss', $likeSearch, $likeSearch);
    if (!empty($date)) $countStmt->bind_param('s', $date);
    $countStmt->execute();

    $totalNotifications = $countStmt->get_result()->fetch_assoc()['total'];
    $totalPages = ceil($totalNotifications / $limit);

    // Response
    echo json_encode([
        'notifications' => $notifications,
        'totalPages' => $totalPages
    ]);
} catch (mysqli_sql_exception $e) {
    die(json_encode(['error' => 'Database query failed: ' . $e->getMessage()]));
}
?>
