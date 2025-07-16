<?php  
session_start(); 
  include('connection.php');


$userID = $_SESSION['userID']; 



$sql = "SELECT order_date, status FROM orders WHERE userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID); 
$stmt->execute();
$result = $stmt->get_result();

  $bookings = [];

  while ($row = mysqli_fetch_assoc($result)){
      $bookings[] = $row;
  }

  echo "<script>const bookingsFromPHP = " . json_encode($bookings).";</script>";



?>



<!DOCTYPE html>
<html lang = "en">
<head> 
  <meta charset="utf=8">
  <meta name="viewport" content="width=device-width, inital-scale=1">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="../CSS/reviewbookings.css">

  <!--For font for brand-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Glass+Antiqua&family=Marck+Script&display=swap" rel="stylesheet">

  <title>My Bookings</title>


</head>
<body>

<div id="bgimg"> </div>


    <div class="navBar">
              
  

      <div class="navLogo">
        <a href="../index.html">
          <img id="brandlogo" src="../IMAGES/logo3.png" alt="Logo">  
        </a>
        
      </div>
      
        <nav class="sideBar">

          <a id="closeBtn" onclick=hideSideBar()> <svg xmlns="http://www.w3.org/2000/svg" height="27x" viewBox="0 -960 960 960" width="27px" fill="black"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a>
        
          <a id="linkSide" href="../index.html" target="_self"> HOME </a>

          <a id="linkSide" href="gallery.html" target="_self"> GALLERY </a>

          <a id="linkSide" href="about company.html" target="_self"> COMPANY </a>

          <a id="linkSide" href="contact.html" target="_self"> CONTACT US </a>

          <a id="linkSide" href="reserve date.html" target="_self"> RESERVE A DATE </a>

        </nav>

        <nav class="menu">
          <div class="menuLeft">
          <a class="hideOnMobile" href="../index.html" target="_self"> HOME </a>

          <a class="hideOnMobile" href="gallery.html" target="_self"> GALLERY </a></button>

          <a class="hideOnMobile" href="about company.html" target="_self"> COMPANY </a>

          <a class="hideOnMobile" href="contact.html" target="_self"> CONTACT US </a>
          </div>
          <div>
          <a class="hideOnMobile" href="reserve date.html" id="reserve" target="_self"> RESERVE A DATE </a>
          </div>
        </nav>

        
        <p id="menuButton" onclick= openSideBar()> <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> </p>

        



  </div>

 
  <!-- NAVBAR END  --> 



<!--Start table -->

<div class="contentContainer">  
   <div style="margin-left: 20px;">
                <button id="tab-pending" style="border: solid lightcoral">Pending</button>
                <button id="tab-completed" style="border: solid lightgreen">Completed</button>
            </div>
      <div class="tableContainer"> 
        <div id="menuTitle">
          <h2>Bookings</h2>
          </div>

          <table id="myTable">
            <thead>
              <tr>
                
                <th>Booking Date</th>
                <th>Status</th>
                <th>Edit</th>
              </tr>

            </thead>
            <tbody>
              <!-- insert rows -->
            </tbody>

          </table> 
          <div id="nextPage" class="pagination"></div>

     </div>
 </div> 







    
<script>  
const pendingTab = document.getElementById("tab-pending");
  const completedTab = document.getElementById("tab-completed");

const tableBooking = document.querySelector("#myTable tbody");
const bookingData = bookingsFromPHP
const rowPerPage = 5;

function pagination (data, tableBody, page){
    tableBody.innerHTML = "";


  const start = (page - 1) * rowPerPage;
  const end = start + rowPerPage;
  const pageData = data.slice(start, end);

    pageData.forEach(booking => {
        const row = document.createElement("tr");
        const nameCell = document.createElement("td"); 
        const statusCell = document.createElement("td"); 
         const editButton = document.createElement("button");
        nameCell.textContent = booking.order_date;  
        statusCell.textContent = booking.status;  
        editButton.textContent = 'Edit'; 
        row.appendChild(nameCell);
        row.appendChild(statusCell); 
        row.appendChild(editButton);
        tableBody.appendChild(row);

    });
} 

function pageControls (containerId, data, tableBody){
  const container = document.getElementById(containerId);
  container.innerHTML = "";

  const totalPages = Math.ceil (data.length / rowPerPage);
  
  for (let i = 1; i <= totalPages; i++){
    const btn = document.createElement("button");
    btn.textContent = i;
    btn.classList.add ("page-btn");
    btn.addEventListener("click", () => pagination(data, tableBody, i));
    container.appendChild(btn);
  }
}


pagination(bookingData, tableBooking, 1);
pageControls("nextPage", bookingData, tableBooking);

   

pendingTab.addEventListener("click", () => {
  const pendingData = bookingData.filter(b => b.status.toLowerCase() === "pending");
  pagination(pendingData, tableBooking, 1);
  pageControls("nextPage", pendingData, tableBooking);
});

completedTab.addEventListener("click", () => {
  const completedData = bookingData.filter(b => b.status.toLowerCase() === "completed");
  pagination(completedData, tableBooking, 1);
  pageControls("nextPage", completedData, tableBooking);
});


</script> 

</body>
</html> 