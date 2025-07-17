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

$sql = "delete from login where userID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)){
    echo "<script>alert('user deleted successfully'); window.location.href = 'adminPage.php';</script>";
} else {
    echo "deletion unsuccessfully :(";
}

?>

