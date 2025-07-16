<?php
include ('connection.php');

if(!isset($_GET['id'])){
    echo "no user ID Provided";
    exit();
}


$id = $_GET['id'];

$sql = "select * from login where user_id = ?";
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

    $update_sql = "update login set username = ? where user_id = ?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "si", $new_username, $id);

    if (mysqli_stmt_execute($update_stmt)){
        echo "<script>alert('User Updated Successfully'); window.location.href = 'adminPage.php';</script>";
    } else {
        echo "error updating user.";
    }
}


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/update_page_1.css">

</head>
  <body>
    <div id="formEdit">
        <h1 id="heading">Edit Form</h1>
        <form name="form" action="update_page_1.php?id=<?php echo $id;?>" method="POST">
            <label>Edit Name: </label>
            <input type="text" id="username" name="username" required><br><br>
            <input type="submit" id="btn" value="Edit" name = "submit"/>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>