<?php 
session_start();

if (isset($_SESSION['username'], $_SESSION['UserType']) && $_SESSION['UserType'] === 'customer') {
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
  

$login = false;
include('connection.php');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'] ;

 
    $stmt = $conn->prepare("SELECT username, password, UserType, userID FROM login WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
        
            $_SESSION['username'] = $row['username'];
            $_SESSION['UserType'] = $row['UserType'];
            $_SESSION['userID'] = $row['userID'];
            $_SESSION['loggedin'] = true;
           
         
            if ($_SESSION['UserType'] === 'admin') {
                header("Location: adminPage.php");
                exit;
            } elseif ($_SESSION['UserType'] === 'employee') {
                header("Location: ../HTML/employeePage.php");
                exit;
            } else {
                header("Location: reserve_date.php");
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

     <!--For font for brand-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Glass+Antiqua&family=Marck+Script&display=swap" rel="stylesheet">



   

</head>

<body> 
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
            crossorigin="anonymous">  </script>
        
    <script>
        
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
