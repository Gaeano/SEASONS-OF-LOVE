<?php 
session_start();


if (isset($_SESSION['username'])) {
    header("Location: ../HTML/employeePage.php");
    exit();
    }
?>
<?php
  

$login = false;
include('connection.php');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'] ;

 
    $stmt = $conn->prepare("SELECT username, password, UserType FROM login WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
        
            $_SESSION['username'] = $row['username'];
            $_SESSION['UserType'] = $row['UserType'];
            $_SESSION['loggedin'] = true;

         
            if ($_SESSION['UserType'] === 'admin') {
                header("Location: adminPage.php");
                exit;
            } elseif ($_SESSION['UserType'] === 'employee') {
                header("Location: ../HTML/employeePage.php");
                exit;
            } else {
                header("Location: ../HTML/reserve date.html");
                exit;
            }
        }
    }


    echo '<script>
            alert("Login failed. Invalid username or password!!");
            window.location.href = "employeeLoginPage.php";
          </script>';
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="with=device-width-width, initial-scale=1.0">
    <title>Login</title>
   <link rel="stylesheet" href="../CSS/login.css"> 

</head>

<body>
    <div id="form">
        <h1> Seasons Of Love </h1>
        <h3>Login</h3>
        <form name="form" method="POST" action="employeeLoginPage.php">
            <label>Username: </label>
            <input type="text" id="username" name="username"><br><br>
            <label>Password: </label>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" id=btn value="Login" name="submit"/>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

</body> 
</html>
