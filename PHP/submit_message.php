<?php
header("Content-Type: application/json");
require __DIR__ . '/db.php'; 

$data = json_decode(file_get_contents("php://input"), true);

$name = trim($data["name"] ?? "");
$email = trim($data["email"] ?? "");
$message = trim($data["message"] ?? "");

if (!$name || !$email || !$message) {
  echo json_encode(["success" => false, "error" => "Missing fields"]);
  exit;
}


$sql = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);

try {
  $stmt->execute([$name, $email, $message]);
  echo json_encode(["success" => true]);
} catch (PDOException $e) {
  echo json_encode(["success" => false, "error" => $e->getMessage()]);
}