<?php
// Start session
session_start();

// Database connection
include '../assets/php/conn.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle AJAX request for notifications
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $limit = 5; // Number of notifications per page
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    $type = isset($_GET['type']) ? $_GET['type'] : 'all';
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $date = isset($_GET['date']) ? trim($_GET['date']) : '';

    try {
        // Base query with dynamic filters
        $query = "SELECT * FROM notifications WHERE 1=1";
        $params = [];
        $types = "";

        // Apply filters dynamically
        if ($type !== 'all') {
            $query .= " AND type = ?";
            $params[] = $type;
            $types .= "s";
        }

        if (!empty($search)) {
            $query .= " AND (title LIKE ? OR description LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $types .= "ss";
        }

        if (!empty($date)) {
            $query .= " AND date = ?";
            $params[] = $date;
            $types .= "s";
        }

        $query .= " ORDER BY date DESC LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        $types .= "ii";

        // Prepare and execute query
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            throw new Exception("Failed to prepare query: " . $conn->error);
        }

        // Bind parameters only if there are any
        if (!empty($types)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $notifications = $result->fetch_all(MYSQLI_ASSOC);

        // Count total notifications
        $countQuery = "SELECT COUNT(*) as total FROM notifications WHERE 1=1";
        $countParams = [];
        $countTypes = "";

        if ($type !== 'all') {
            $countQuery .= " AND type = ?";
            $countParams[] = $type;
            $countTypes .= "s";
        }

        if (!empty($search)) {
            $countQuery .= " AND (title LIKE ? OR description LIKE ?)";
            $countParams[] = "%$search%";
            $countParams[] = "%$search%";
            $countTypes .= "ss";
        }

        if (!empty($date)) {
            $countQuery .= " AND date = ?";
            $countParams[] = $date;
            $countTypes .= "s";
        }

        $countStmt = $conn->prepare($countQuery);
        if ($countStmt === false) {
            throw new Exception("Failed to prepare count query: " . $conn->error);
        }

        // Bind parameters for the count query only if there are any
        if (!empty($countTypes)) {
            $countStmt->bind_param($countTypes, ...$countParams);
        }

        $countStmt->execute();
        $totalNotifications = $countStmt->get_result()->fetch_assoc()['total'];
        $totalPages = ceil($totalNotifications / $limit);

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'documents' => $notifications,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
        exit();
    } catch (Exception $e) {
        // Error response
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'An error occurred: ' . $e->getMessage()
        ]);
        exit();
    }
}
?>
