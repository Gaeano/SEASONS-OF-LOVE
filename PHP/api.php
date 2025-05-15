<?php
header("Content-Type: application/json");


$host = "localhost";      
$dbname = "s19010108_seasonsoflove";      
$user = "s19010108_seasonsoflove";              
$password = "mutiamanlangitherediasanding2025";     

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Oopsie Woopsie something went weally wong :3" . $e->getMessage()]);
    exit;
}


$sql = "
    SELECT 
        o.order_id, 
        o.customer_name,
        o.customer_phone,
        o.order_date,
        o.status,
        d.name AS dish_name,
        oi.quantity
    FROM orders o
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN dishes d ON oi.dish_id = d.dish_id
    ORDER BY o.order_id DESC, d.name ASC
";

$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


$orders = [];

foreach ($rows as $row) {
    $oid = $row['order_id'];

    if (!isset($orders[$oid])) {
        $orders[$oid] = [
            'order_id' => $oid, 
            'customer_name' => $row['customer_name'],
            'customer_phone' => $row['customer_phone'],
            'order_date' => $row['order_date'], 
            'status' => $row['status'],
            'items' => []
        ];
    }

    $orders[$oid]['items'][] = [
        'dish_name' => $row['dish_name'],
        'quantity' => $row['quantity']
    ];
}

// Re-index numerically for clean JSON
echo json_encode(array_values($orders));