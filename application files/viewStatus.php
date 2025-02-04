<?php
session_start();

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

// Pagination and search
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

// Query to fetch data with cataloguer details
$query = "SELECT 
            bi.Book_ID AS id, 
            bi.PublicationTitle AS title, 
            bi.Genre AS description, 
            bi.FileUpload AS file_path, 
            bi.PublisherEmail AS PublisherEmail, 
            bi.Isbn AS isbn, 
            bi.status,
            u.FullName AS cataloguer_name
          FROM book_informationsheet bi
          LEFT JOIN assignments a ON bi.Book_ID = a.book_id
          LEFT JOIN users u ON a.cataloguer_id = u.User_ID";

if ($searchTerm !== '') {
    $query .= " WHERE bi.PublicationTitle LIKE :search OR bi.Genre LIKE :search OR bi.Isbn LIKE :search";
}
$query .= " LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($query);
if ($searchTerm !== '') {
    $stmt->bindValue(':search', '%' . $searchTerm . '%', PDO::PARAM_STR);
}
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Total record count for pagination
$countQuery = "SELECT COUNT(*) as total FROM book_informationsheet";
if ($searchTerm !== '') {
    $countQuery .= " WHERE PublicationTitle LIKE :search OR Genre LIKE :search OR Isbn LIKE :search";
}
$countStmt = $pdo->prepare($countQuery);
if ($searchTerm !== '') {
    $countStmt->bindValue(':search', '%' . $searchTerm . '%', PDO::PARAM_STR);
}
$countStmt->execute();
$totalRecords = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalRecords / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status Management</title>
  <link href="../assets/img/favicon.webp" rel="icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .sidebar { background-color: #343a40; color: white; min-height: 100vh; }
    .sidebar a { color: white; text-decoration: none; padding: 10px 20px; display: block; font-weight: bold; }
    .sidebar a:hover { background: #495057; border-radius: 5px; }
    @media (max-width: 768px) { .sidebar { position: fixed; width: 100%; height: auto; z-index: 1000; } }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block sidebar">
        <h3 class="text-center py-3">Status</h3>
        <ul class="nav flex-column">
          <li class="nav-item"><a href="adminDashboard.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
        </ul>
      </nav>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h1 class="mt-4">Status Management</h1>

        <!-- Display Success/Error Messages -->
        <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
          <?php unset($_SESSION['success']); ?>
        <?php elseif (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
          <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Search Bar -->
        <div class="input-group mb-4">
          <input type="text" id="search-input" class="form-control" placeholder="Search documents..." value="<?= htmlspecialchars($searchTerm) ?>">
          <button class="btn btn-primary" onclick="search()">Search</button>
        </div>

        <!-- Table -->
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>PublisherEmail</th>
                <th>ISBN</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Cataloguer Assigned</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($documents)): ?>
                <tr><td colspan="8" class="text-center">No documents found.</td></tr>
              <?php else: ?>
                <?php foreach ($documents as $doc): ?>
                  <tr>
                    <td><?= htmlspecialchars($doc['id']) ?></td>
                    <td><?= htmlspecialchars($doc['PublisherEmail']) ?></td>
                    <td><?= htmlspecialchars($doc['isbn']) ?></td>
                    <td><?= htmlspecialchars($doc['title']) ?></td>
                    <td><?= htmlspecialchars($doc['description']) ?></td>
                    <td><?= htmlspecialchars($doc['status']) ?></td>
                    <td><?= htmlspecialchars($doc['cataloguer_name'] ?? 'Unassigned') ?></td>
                    <td>
                      <form action="update_status.php" method="POST" class="d-inline">
                        <input type="hidden" name="Book_ID" value="<?= htmlspecialchars($doc['id']) ?>">
                        <select name="status" class="form-select form-select-sm" required>
                          <option value="Assigned" <?= $doc['status'] === 'Assigned' ? 'selected' : '' ?>>Assigned</option>
                          <option value="In Progress" <?= $doc['status'] === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                          <option value="Completed" <?= $doc['status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary" disabled>Update</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <nav>
          <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
              <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>&search=<?= htmlspecialchars($searchTerm) ?>"><?= $i ?></a>
              </li>
            <?php endfor; ?>
          </ul>
        </nav>
      </main>
    </div>
  </div>

  <script>
    function search() {
      const searchInput = document.getElementById('search-input');
      const searchQuery = searchInput.value.trim();
      window.location.href = `?search=${encodeURIComponent(searchQuery)}`;
    }
  </script>
</body>
</html>
