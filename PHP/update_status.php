<?php
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$order_id = $data['order_id'] ?? null;
$status = $data['status'] ?? null;

if (!$order_id || !in_array($status, ['pending', 'completed'])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid input"]);
    exit;
}

require 'db.php'; 

$stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
$stmt->execute([$status, $order_id]);

echo json_encode(["success" => true]);