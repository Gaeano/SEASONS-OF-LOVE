<?php
header("Content-Type: application/json");

require __DIR__ . '/db.php'; 

$sql = "SELECT DISTINCT DATE(order_date) as order_day FROM orders";
$stmt = $pdo->query($sql);
$dates = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($dates);