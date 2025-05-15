<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['name'], $data['email'], $data['contact'], $data['date'], $data['dishes'])) {
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
    exit;
}

require __DIR__ . '/db.php';

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("INSERT INTO orders (customer_name, customer_phone, order_date, status) VALUES (?, ?, ?, 'pending')");
    $stmt->execute([$data['name'], $data['contact'], $data['date']]);


    $orderId = $pdo->lastInsertId();

    $dishMap = [
        'Beef Caldereta' => 1,
        'Beef Stroganoff' => 2, 
        'Beef Kare-Kare' => 3, 
        'Beef Menudo' => 4, 
        'Beef with Broccoli' => 5, 
        'Bistik Tagalog' => 6, 
        'Ampalaya con Carne' => 7, 
        'Chicken Afritada' => 8, 
        'Chicken Curry' => 9, 
        'Chicken Fillet' => 10, 
        'Chicken Asado' => 11, 
        'Chicken Adobo with Egg' => 12, 
        'Chicken Strips' => 13, 
        'Chicken Embotido' => 14, 
        'Chicken Meatballs' => 15, 
        'Buffalo Wings' => 16, 
        'Fried Chicken' => 17, 
        'Chicken Sweet & Sour' => 18, 
        'Chicken Cordon Bleu' => 19, 
        'Chicken Ala King' => 20, 
        'Pork Embotido' => 21, 
        'Pork Steak' => 22, 
        'Pork Menudo' => 23, 
        'Pork Afritada' => 24, 
        'Pork Binagoongan' => 25, 
        'Bicol Express' => 26, 
        'Sweet & Sour Meatballs' => 27, 
        'Shanghai Roll' => 28, 
        'Pork Kare-Kare' => 29, 
        'Pork Sweet & Sour' => 30, 
        'Pork Humba' => 31, 
        'Pork Asado' => 32, 
        'Fish Kinilaw' => 33, 
        'Sweet & Sour Fish' => 34, 
        'Chopsuey Seafood' => 35, 
        'Fish Fillet' => 37, 
        'Bihon Guisado' => 38, 
        'Pancit Canton' => 39, 
        'Bam-i' => 40, 
        'Sotanghon Guisado' => 41, 
        'Special Spaghetti' => 42, 
        'Vegetable Lumpia' => 43,  
        'Chicken Salad' => 44, 
        'Fruit Macaroni Salad' => 45, 
        'Fruit Salad' => 46, 
        'Buko Pandan' => 47,  
        'Fresh Fruits' => 48,
        'Black Sambo' => 49, 
        'Macaroni Salad' => 50, 
    ];

    $insertItem = $pdo->prepare("INSERT INTO order_items (order_id, dish_id, quantity) VALUES (?, ?, ?)");

  
   foreach ($data['dishes'] as $dish) {
    $name = $dish['name'];
    $quantity = (int)$dish['quantity'];

    if (!isset($dishMap[$name])) continue;

    $insertItem->execute([$orderId, $dishMap[$name], $quantity]);
}


    $pdo->commit();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
