<?php
require_once('../assets/php/conn.php');

// Fetch books
$bookQuery = "SELECT * FROM book_informationsheet";
$bookResults = mysqli_query($conn, $bookQuery);

// Fetch cataloguers
$cataloguerQuery = "SELECT * FROM users ";
$cataloguerResults = mysqli_query($conn, $cataloguerQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/img/favicon.webp" rel="icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Book Details</title>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .table-container {
      margin: 20px auto;
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .table th, .table td {
      vertical-align: middle;
      text-align: center;
    }
  </style>
</head>
<body>
        <!-- Home Button Icon -->
        <a href="adminDashboard.php" class="home-icon">
        <i class="bi bi-house-fill"></i> Admin Dashboard
    </a>
  <div class="container table-container">
    <h1 class="mb-4 text-center">Book Details</h1>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Book ID</th>
            <th>Publisher Email</th>
            <th>Author Name</th>
            <th>Book Title</th>
            <th>ISBN</th>
            <th>Assign to</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($bookResults) > 0): ?>
            <?php while ($book = mysqli_fetch_assoc($bookResults)): ?>
              <tr>
                <td><?= htmlspecialchars($book['Book_ID']) ?></td>
                <td><?= htmlspecialchars($book['PublisherEmail']) ?></td>
                <td><?= htmlspecialchars($book['AuthorName']) ?></td>
                <td><?= htmlspecialchars($book['PublicationTitle']) ?></td>
                <td><?= htmlspecialchars($book['Isbn']) ?></td>
                <td>
                  <form action="assign_task.php" method="POST" class="d-inline">
                    <input type="hidden" name="Book_ID" value="<?= htmlspecialchars($book['Book_ID']) ?>">
                    <select name="cataloguer_id" class="form-select form-select-sm" required>
                      <option value="">Select Cataloguer</option>
                      <?php 
                      mysqli_data_seek($cataloguerResults, 0); // Reset cataloguer results pointer
                      while ($cataloguer = mysqli_fetch_assoc($cataloguerResults)): ?>
                        <option value="<?= htmlspecialchars($cataloguer['User_ID']) ?>">
                          <?= htmlspecialchars($cataloguer['FullName']) ?>
                        </option>
                      <?php endwhile; ?>
                    </select>
                </td>
                <td>
                    <button type="submit" class="btn btn-primary btn-sm">Assign</button>
                  </form>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="text-center">No books found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
