<?php 
    session_start();

    if (isset($_SESSION['username'])) {
    header("Location: ../HTML/admintest.php");
    exit();
    }
?>
<?php
    $login = false;
    include('connection.php');
    
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE username = '$username'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  

        if ($row){

            if (password_verify($password, $row["password"])){
                $login = true;

                session_start();

                $sql = "select username from users where username = '$username'";
                $r = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC) ;

                $_SESSION['username'] = $r['username'];
                $_SESSION['loggedin'] = true;
                
                header("Location: ../HTML/admintest.php");
            }
        } else {
             echo '<script>
                        alert("Login failed. Invalid username or password!!");
                       window.location.href = "adminloginPage.php";
                     </script>';
        }
        
        // if($count == 1){  
        //     $_SESSION['username'] = $username;
        //     header("Location: ../HTML/admintest.php"); 
        // }  
        // else{  
        //     echo '<script>
        //                 alert("Login failed. Invalid username or password!!");
        //                window.location.href = "adminloginPage.php";
        //              </script>';
        // }     
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
        <h1> Seasons Of Love <h1>
        <h3>Login</h3>
        <form name="form" method="POST" action="adminLoginPage.php">
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
