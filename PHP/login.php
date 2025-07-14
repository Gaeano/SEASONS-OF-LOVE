<?php
    session_start();
    include('connection.php');
    
   

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        
        if($count == 1){  
            $_SESSION['username'] = $username;  
            $_SESSION['usertype'] = $usertype; 
            if(){ 
            header("Location: ../HTML/admintest.php");  
            }
        }  
        else{  
            echo '<script>
                        alert("Login failed. Invalid username or password!!");
                       window.location.href = "adminloginPage.php";
                     </script>';
        }     
    } 
?>