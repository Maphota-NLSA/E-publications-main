<?php
// Start session
session_start();

// Database connection
include 'conn.php';

// Pagination variables
$limit = 5; // Number of notifications per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Filters
$type = isset($_GET['type']) ? $_GET['type'] : 'all';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';

try {
    // Base query
    $query = "SELECT * FROM notifications WHERE 1=1";
    $params = [];
    $types = "";

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

    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    $notifications = $result->fetch_all(MYSQLI_ASSOC);

    // Get total notifications count
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
    $countStmt->bind_param($countTypes, ...$countParams);
    $countStmt->execute();
    $totalNotifications = $countStmt->get_result()->fetch_assoc()['total'];
    $totalPages = ceil($totalNotifications / $limit);

    // Response
    echo json_encode([
        'success' => true,
        'documents' => $notifications,
        'totalPages' => $totalPages
    ]);
} catch (mysqli_sql_exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database query failed: ' . $e->getMessage()]);
}
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .notification-item {
            transition: background-color 0.3s, transform 0.3s;
        }
        .notification-item:hover {
            background-color: #e9ecef;
            transform: scale(1.01);
        }
        .filter-bar {
            margin-bottom: 1.5rem;
        }
        .pagination {
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <h2 class="mb-4">Notifications</h2>

        <!-- Search and Filters -->
        <div class="filter-bar d-flex flex-wrap gap-3">
            <input
                type="text"
                id="search-bar"
                class="form-control"
                placeholder="Search notifications..."
                style="max-width: 300px;"
            >
            <select id="type-filter" class="form-select" style="max-width: 200px;">
                <option value="all">All Types</option>
                <option value="catalogue">New Catalogue</option>
                <option value="reminder">Reminder</option>
                <option value="alert">Alert</option>
            </select>
            <input type="date" id="date-filter" class="form-control" style="max-width: 200px;">
            <button class="btn btn-primary" id="apply-filters">Apply Filters</button>
        </div>

        <!-- Notification List -->
        <ul id="notification-list" class="list-group">
            <!-- Notifications will be dynamically loaded here -->
        </ul>

        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <!-- Pagination buttons will be dynamically added -->
            </ul>
        </nav>
    </div>

    <script>
        const notificationList = document.getElementById("notification-list");
        const paginationContainer = document.querySelector(".pagination");

        // Fetch notifications from the backend
        async function fetchNotifications(page = 1) {
            const searchQuery = document.getElementById("search-bar").value;
            const typeFilter = document.getElementById("type-filter").value;
            const dateFilter = document.getElementById("date-filter").value;

            try {
                const response = await fetch(`notifications.php?page=${page}&search=${searchQuery}&type=${typeFilter}&date=${dateFilter}`);
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                const data = await response.json();

                if (!data.success) {
                    notificationList.innerHTML = `<li class="list-group-item text-danger">${data.message}</li>`;
                    return;
                }

                renderNotifications(data.documents);
                renderPagination(data.totalPages, page);
            } catch (error) {
                notificationList.innerHTML = `<li class="list-group-item text-danger">Failed to load notifications: ${error.message}</li>`;
                console.error("Fetch error:", error);
            }
        }

        // Render notifications
        function renderNotifications(notifications) {
            notificationList.innerHTML = ""; // Clear current notifications

            if (notifications.length === 0) {
                notificationList.innerHTML = `<li class="list-group-item text-muted">No notifications found.</li>`;
                return;
            }

            notifications.forEach(notification => {
                const notificationItem = `
                    <li class="list-group-item notification-item">
                        <h5>${notification.title}</h5>
                        <p class="mb-1">${notification.description}</p>
                        <small class="text-muted">Type: ${notification.type} | Date: ${notification.date}</small>
                    </li>
                `;
                notificationList.innerHTML += notificationItem;
            });
        }

        // Render pagination
        function renderPagination(totalPages, currentPage) {
            paginationContainer.innerHTML = ""; // Clear existing pagination

            if (totalPages <= 1) return;

            for (let i = 1; i <= totalPages; i++) {
                const pageItem = document.createElement("li");
                pageItem.className = `page-item ${i === currentPage ? "active" : ""}`;
                pageItem.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                pageItem.addEventListener("click", (e) => {
                    e.preventDefault();
                    fetchNotifications(i);
                });
                paginationContainer.appendChild(pageItem);
            }
        }

        // Apply filters and fetch notifications
        document.getElementById("apply-filters").addEventListener("click", () => fetchNotifications());

        // Initial load
        fetchNotifications();
    </script>
</body>
</html>
