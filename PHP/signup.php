
<?php
    include("connection.php");
    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);
       
        
        $sql="select * from login where username='$username'";
        $result = mysqli_query($conn, $sql);
        $count_user = mysqli_num_rows($result);

        $sql="select * from login where email='$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        if($count_user == 0 & $count_email==0){
            if($password==$cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO login(username, email, password, userType) VALUES('$username', '$email', '$hash', 'employee')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo '<script> alert("Account Successfully Created");
                    window.location.href = "adminPage.php";
                    </script>';
                    exit();
                    
                }
            }
            else{
                echo '<script>
                    alert("Passwords do not match");
                    window.location.href = "adminPage.php?error=password_mismatch";
                </script>';
            }
        }
        else{
            if($count_user>0){
                echo '<script>
                    window.location.href="adminPage.php?error=username_exists";
                    alert("Username already exists!!");
                </script>';
            }
            if($count_email>0){
                echo '<script>
                    window.location.href="adminPage.php?error=email_exists";
                    alert("Email already exists!!");
                </script>';
            }
        }
        
    }
?>
