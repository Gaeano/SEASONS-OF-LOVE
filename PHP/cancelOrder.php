<?php
include('connection.php');
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST['order_id'])) {
    http_response_code(400);
    echo json_encode(["success" => false, "error" => "Missing or invalid order ID."]);
    exit();
}

$orderID = $_POST['order_id'];

// Update the order status to 'cancelled'
$sql = "UPDATE orders SET status = 'cancelled' WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $orderID);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Database error: " . $stmt->error]);
}
?>