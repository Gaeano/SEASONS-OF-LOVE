<?php
session_start();
include('connection.php');


if (!isset($_SESSION['UserType']) || $_SESSION['UserType'] !== 'admin') {
    header("Location: ../HTML/reserve date.html");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'], $_POST['category'], $_POST['image_path']) && isset($_GET['id'])) {
        $dishID = intval($_GET['id']);
        $dishName = trim(mysqli_real_escape_string($conn, $_POST['name']));
        $category = trim(mysqli_real_escape_string($conn, $_POST['category']));
        $imagePath = trim(mysqli_real_escape_string($conn, $_POST['image_path'])); 
        $description = trim(mysqli_real_escape_string($conn, $_POST['description'] ?? ''));

        if ($dishName === '' || $category === '') {
            echo '<script>alert("Dish Name and Category are required.");
                  window.location.href = "adminPage.php";</script>';
            exit();
        }

        $sql = "UPDATE dishes SET `NAME` = ?, category = ?, image_path = ?, description = ? WHERE dish_id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
           mysqli_stmt_bind_param($stmt, "ssssi", $dishName, $category, $imagePath, $description, $dishID);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                header("Location: adminPage.php?update=success");
                exit();
            } else {
                echo '<script>alert("Failed to update dish.");
                      window.location.href = "adminPage.php";</script>';
                exit();
            }
        } else {
            echo '<script>alert("Database error.");
                  window.location.href = "adminPage.php";</script>';
            exit();
        }
    } else {
        echo '<script>alert("Invalid form submission.");
              window.location.href = "adminPage.php";</script>';
        exit();
    }
} else {
    header("Location: adminPage.php");
    exit();
}
?>
