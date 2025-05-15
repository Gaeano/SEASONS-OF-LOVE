<?php 
    session_start();

    if (isset($_SESSION['username'])) {
    header("Location: ../HTML/admintest.php");
    exit();
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
        <h1> Linear <h1>
        <h3>Login</h3>
        <form name="form" method="POST" action="login.php">
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
