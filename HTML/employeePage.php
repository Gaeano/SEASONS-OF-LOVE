<?php 
   session_start();
     if (!isset($_SESSION['username'])) {
    header("Location: ../PHP/employeeLoginPage.php");
    exit();
}
?>

<!DOCTYPE html>  
<html lang = "en"> 
<head>
<title>Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

     <link rel="stylesheet" href="../CSS/employeePage.css">

  
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
        


          <a id="linkSide" href="employeePage.php" target="_self"> MANAGE BOOKINGS </a>
          <a id="linkSide" href="empManagementPage.php" target="_self"> MANAGE MENU </a>
          <a id="linkSide" href="../PHP/reviewFeedbackPage.php" target="_self"> CUSTOMER FEEDBACK </a>
          <a id="linkSide" href="../PHP/adminPage.php" target="_self"> ADMIN </a>


        </nav>

        <nav class="menu">
          <div class="menuLeft">
     
          </div>
          <div>

          <a class="hideOnMobile" id="reserve" href="employeePage.php" target="_self"> MANAGE BOOKINGS </a>
          <a class="hideOnMobile" id="reserve" href="empManagementPage.php" target="_self"> MANAGE MENU </a>
          <a class="hideOnMobile" id="reserve" href="../PHP/reviewFeedbackPage.php" target="_self"> CUSTOMER FEEDBACK </a>
          <a class="hideOnMobile" id="reserve" href="../PHP/adminPage.php" target="_self"> ADMIN </a>
          


          </div>
        </nav>



        <p id="menuButton" onclick= openSideBar()> <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> </p>

  </div>
<!-- NAV BAR END -->
  
<div id="orderdatecontainer">
        <div class="orderorder">
            <div class="order_list"> 
                <button id="tab-cancelled">Cancelled</button>
                <button id="tab-pending">Pending</button>
                <button id="tab-completed">Completed</button> 
            </div>
    
            <div id="order-container"></div>
        </div>  

        <div class="calcal">
        <div class="calendar-wrapper">
            <div id="calendar-header"></div>
            <div id="calendar" class="calendar" ></div>



            <!-- <form action="../PHP/logout.php" method="post">
        <button class="logoutt" type="submit">Logout</button>
    </form> -->
        </div>

         </div>


</div>

    





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../JS/displayreqs.js"></script> 
<script src="../JS/calendar.js"></script>
</body>  
</html> 
