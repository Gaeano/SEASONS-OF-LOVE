<?php
include('connection.php'); // or db.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dish_id'])) {
    $id = intval($_POST['dish_id']);

    // Flip isAvailable using NOT operator
    $sql = "UPDATE dishes SET isAvailable = NOT isAvailable WHERE dish_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo "Availability updated.";
    } else {
        echo "Error updating availability.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
