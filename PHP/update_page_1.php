<?php
include ('connection.php');

if(!isset($_GET['id'])){
    echo "no user ID Provided";
    exit();
}


$id = $_GET['id'];


$sql = "select * from login where userID = ?";

$stmt = mysqli_prepare($conn, $sql); 
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$count_user = mysqli_num_rows($result);

if ($count_user === 0){
    echo "user not found;";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $new_username = $_POST['username'];
    $existingUsername = "select * from login where username = ?";
    $check = mysqli_prepare($conn, $existingUsername);
    mysqli_stmt_bind_param($check, "s", $new_username);
    mysqli_stmt_execute($check);
    $checkUsername = mysqli_stmt_get_result($check);


    if (mysqli_num_rows($checkUsername) > 0) {
        echo "<script>alert('Username already exists'); window.location.href='adminPage.php';</script>";
        exit();
    }


    $update_sql = "update login set username = ? where userID = ?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "si", $new_username, $id);

    if (mysqli_stmt_execute($update_stmt)){
        echo "<script>alert('User Updated Successfully'); window.location.href = 'adminPage.php';</script>";

    } else {
        echo  "<script> alert('error updating user'); </script>";
        
    }

    }
?>

