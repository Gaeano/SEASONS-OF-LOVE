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
</head> 



<body>
  
<div style="display: flex; flex-direction: row; gap: 3vw; width: 100%; margin: 20px; margin-left: 3.5vw;" id="orderdatecontainer">
        <div>
            <div style="margin-left: 20px;">
                <button id="tab-pending" style="border: solid lightcoral">Pending</button>
                <button id="tab-completed" style="border: solid lightgreen">Completed</button>
            </div>
    
            <div id="order-container"></div>
        </div>  
        
        <div class="calendar-wrapper">
            <div id="calendar-header"></div>
            <div id="calendar" class="calendar" ></div>
        </div>


</div>

    <form action="../PHP/logout.php" method="post">
        <button type="submit">Logout</button>
    </form>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../JS/displayreqs.js"></script> 
<script src="../JS/calendar.js"></script>
</body>  
</html> 
