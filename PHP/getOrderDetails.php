<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST['order_id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing or invalid orderID"]);
    exit();
}


    $orderID = $_POST['order_id'];
 


$sql = "
    SELECT
        oi.dish_id,
        d.NAME,
        oi.quantity
    FROM order_items oi
    JOIN dishes d ON oi.dish_id = d.dish_id
    WHERE oi.order_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $orderID);
$stmt->execute();
$result = $stmt->get_result();

$orderDetails = [];
while ($row = $result->fetch_assoc()) {
    $orderDetails[] = $row;
}

echo json_encode($orderDetails);
?>
