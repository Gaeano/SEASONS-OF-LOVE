<?php
session_start();
include('connection.php');


if (!isset($_SESSION['UserType']) || $_SESSION['UserType'] !== 'admin') {
    header("Location: ../HTML/reserve date.html");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'], $_POST['category']) && isset($_GET['id']) && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $dishID = intval($_GET['id']);
        $dishName = trim(mysqli_real_escape_string($conn, $_POST['name']));
        $category = trim(mysqli_real_escape_string($conn, $_POST['category']));
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);
        $uniqueName = date("Ymd_His") . '_' . $fileName;
        $uploadDir = '../IMAGES/';
        $destination = $uploadDir . $uniqueName;
        $description = trim(mysqli_real_escape_string($conn, $_POST['description'] ?? '')); 



        

        if ($dishName === '' || $category === '') {
            echo '<script>alert("Dish Name and Category are required.");
                  window.location.href = "adminPage.php";</script>';
            exit();
        } 

        move_uploaded_file($fileTmpPath, $destination);

        $sql = "UPDATE dishes SET `NAME` = ?, category = ?, image_path = ?, description = ? WHERE dish_id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) { 
            
           mysqli_stmt_bind_param($stmt, "ssssi", $dishName, $category, $destination, $description, $dishID); 
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
