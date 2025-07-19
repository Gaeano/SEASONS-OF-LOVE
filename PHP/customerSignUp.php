<?php


session_start();

    if(isset($_SESSION['username']  && $_SESSION['UserType'] === 'customer')){ 
        echo "<script> alert('Already Signed in! Redirecting...'); 
              window.location.href = 'reserve_date.php';
        </script>";
    } else if (isset($_SESSION['username']) && $_SESSION['UserType'] === 'admin'){ 
         echo "<script> alert('Already Signed in! Redirecting...'); 
              window.location.href = adminPage.php';
        </script>";
    } else { 
         echo "<script> alert('Already Signed in! Redirecting...'); 
              window.location.href = ../HTML/employeePage.php';
        </script>";

    }
?>
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
                $sql = "INSERT INTO login(username, email, password, UserType) VALUES('$username', '$email', '$hash', 'customer')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header("Location: employeeLoginPage.php");
                }
            }
            else{
                echo '<script>
                    alert("Passwords do not match");
                    window.location.href = "customerSignUp.php";
                </script>';
            }
        }
        else{
            if($count_user>0){
                echo '<script>
                    window.location.href="customerSignUp.phpp";
                    alert("Username already exists!!");
                </script>';
            }
            if($count_email>0){
                echo '<script>
                    window.location.href="customerSignUp.php";
                    alert("Email already exists!!");
                </script>';
            }
        }
        
    }
?>
 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/signup.css">


     <!--For font for brand-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Glass+Antiqua&family=Marck+Script&display=swap" rel="stylesheet">

    <title>Signup</title>

</head>
  <body>


<!-- NAV BAR START -->
<!-- NAV BAR START -->
    <div id="bgimg"> </div>


    <div class="navBar">
              
  

      <div class="navLogo">
       <a href="index.html " >
        <img id="brandlogo" src="../IMAGES/logo3.png" href="index.html" alt="Logo">
       </a>   
      </div>
      
        <nav class="sideBar">

          <a id="closeBtn" onclick=hideSideBar()> <svg xmlns="http://www.w3.org/2000/svg" height="27x" viewBox="0 -960 960 960" width="27px" fill="black"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a>
        
          <a id="linkSide" href="../index.html" target="_self"> HOME </a>

          <a id="linkSide" href="gallery.php" target="_self"> GALLERY </a>

          <a id="linkSide" href="../HTML/about company.html" target="_self"> COMPANY </a>

          <a id="linkSide" href="../HTML/contact.html" target="_self"> CONTACT US </a>

          <a id="linkSide" href="reviewbookings.php" target="_self"> BOOKINGS </a>  

          <a id="linkSide" href="employeeLoginPage.php" target="_self"> LOGIN </a> 

         <a id="linkSide" href="customerSignUp.php" target="_self"> SIGNUP </a>   

          <a id="linkSide" href="reserve_date.php" target="_self"> RESERVE A DATE </a>

                    <a class="linkSide" href="logout.php" target="_self"> LOGOUT </a>


        </nav>

        <nav class="menu">
          <div class="menuLeft">
          <a class="hideOnMobile" href="../index.html" target="_self"> HOME </a>

          <a class="hideOnMobile" href="gallery.php" target="_self"> GALLERY </a></button>

          <a class="hideOnMobile" href="../HTML/about company.html" target="_self"> COMPANY </a>

          <a class="hideOnMobile" href="../HTML/contact.html" target="_self"> CONTACT US</a>

          <a id="hideOnMobile" href="reviewbookings.php" target="_self"> BOOKINGS </a>  
          
          <a class="hideOnMobile" href="employeeLoginPage.php" target="_self"> LOGIN </a> 
        
          <a class="hideOnMobile" href="customerSignUp.php" target="_self"> SIGNUP </a>
          
          

          </div>
          <div>
          <a class="hideOnMobile" id="reserve" href="reserve_date.php" target="_self"> RESERVE A DATE </a>
                    <a class="hideOnMobile" id="reserve" href="logout.php" target="_self"> LOGOUT </a>

          </div>
        </nav>



        <p id="menuButton" onclick= openSideBar()> <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> </p>

        



  </div>
<!-- NAV BAR END -->












    <div id="form">
        <h1 id="heading">SignUp Form</h1>
        <h2> Customer Sign Up</h2>  
        <form name="form" action="customerSignUp.php" method="POST">
            <label>Enter Username: </label>
            <input type="text" id="user" name="user" required><br><br>
            <label>Enter Email: </label>
            <input type="email" id="email" name="email" required><br><br>
            <label>Create Password: </label>
            <input type="password" id="pass" name="pass" required><br><br>
            <label>Retype Password: </label>
            <input type="password" id="cpass" name="cpass" required><br><br>
            <input type="submit" id="btn" value="SignUp" name = "submit"/>
        </form>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
          // JS NAV BAR START
          function openSideBar(){
            const sideBar = document.querySelector(".sideBar");
    
            sideBar.style.display = 'flex';
          }
    
          function hideSideBar(){
            const sideBar = document.querySelector(".sideBar");
    
            sideBar.style.display =  'none';
    
          }
          
          // JS NAV BAR END
    </script>
  </body>
</html>