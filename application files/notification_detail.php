<?php
session_start();
include '../assets/php/conn.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $notification_id = (int)$_GET['id'];

    $query = "SELECT * FROM notifications WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $notification_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $notification = $result->fetch_assoc();
    } else {
        die('Notification not found.');
    }
} else {
    die('Invalid notification ID.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Detail</title>
</head>
<body>
    <h1><?= htmlspecialchars($notification['title']) ?></h1>
    <p><?= htmlspecialchars($notification['description']) ?></p>
    <p>Date: <?= htmlspecialchars($notification['date']) ?></p>
</body>
</html>
