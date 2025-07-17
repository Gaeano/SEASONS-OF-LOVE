<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST['order_id'])) {
    echo json_encode(["success" => false, "error" => "Invalid request"]);
    exit();
}

$orderID = $_POST['order_id'];

// Loop through POST data to find quantities
foreach ($_POST as $key => $value) {
    if (strpos($key, 'quantity_') === 0) {
        $dishID = intval(str_replace('quantity_', '', $key));
        $quantity = intval($value);

        $updateSQL = "UPDATE order_items SET quantity = ? WHERE order_id = ? AND dish_id = ?";
        $stmt = $conn->prepare($updateSQL);
        $stmt->bind_param("iii", $quantity, $orderID, $dishID);
        $stmt->execute();
    }
}

echo json_encode(["success" => true]);