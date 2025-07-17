<?php
header('Content-Type: application/json');
include('connection.php');

$sql = "SELECT image_path, NAME, description FROM dishes";
$result = mysqli_query($conn, $sql);

$dishes = [];

while ($row = mysqli_fetch_assoc($result)) {
    $dishes[] = $row;
}

echo json_encode($dishes);
?>
