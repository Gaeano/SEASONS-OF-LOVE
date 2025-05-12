<?php
    include('connection.php');
    
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM login WHERE name = '$name' AND password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        
        if($count == 1){  
            header("Location: index.html"); //chasnge
            session_start();
        }  
        else{  
            echo '<script>
                        alert("Login failed. Invalid username or password!!");
                       window.location.href = "loginPage.php";
                     </script>';
        }     
    }
?>