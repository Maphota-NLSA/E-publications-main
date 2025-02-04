<?php
include '../assets/php/conn.php';
require_once('../assets/php/adminDashboard.php');

// Fetch all book records along with assigned cataloguer
$query = "SELECT 
            b.Book_ID, 
            b.PublicationTitle, 
            b.Isbn, 
            b.PublisherEmail, 
            u.FullName AS Cataloguer
          FROM 
            book_informationsheet b
          LEFT JOIN 
            assigned_cataloguers ac ON b.Book_ID = ac.book_id
          LEFT JOIN 
            users u ON ac.User_ID = u.User_ID";
$result = mysqli_query($conn, $query);

// Check if the download request is made
if (isset($_GET['download']) && $_GET['download'] === 'excel') {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Book_Report.xls");
    echo "Book ID\tTitle\tISBN\tPublisher Email\tCataloguer\n";

    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['Book_ID'] . "\t" . $row['PublicationTitle'] . "\t" . $row['Isbn'] . "\t" . $row['PublisherEmail'] . "\t" . ($row['Cataloguer'] ?? 'Not Assigned') . "\n";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Books Report</h1>
    <a href="?download=excel" class="btn btn-success mb-3">Download Excel Report</a>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>ISBN</th>
                <th>Publisher Email</th>
                <th>Cataloguer</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['Book_ID']) ?></td>
                    <td><?= htmlspecialchars($row['PublicationTitle']) ?></td>
                    <td><?= htmlspecialchars($row['Isbn']) ?></td>
                    <td><?= htmlspecialchars($row['PublisherEmail']) ?></td>
                    <td><?= htmlspecialchars($row['Cataloguer'] ?? 'Not Assigned') ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
