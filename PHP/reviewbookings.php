<?php  
session_start(); 
  include('connection.php');
if (!isset($_SESSION['UserType'])){
   echo '<script>
            alert("Please Login to access your bookings.");
            window.location.href = "employeeLoginPage.php";
          </script>';
}

$userID = $_SESSION['userID']; 



$sql = "SELECT order_date, status, order_id FROM orders WHERE userID = ?";
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
          </div>
        </nav>



        <p id="menuButton" onclick= openSideBar()> <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> </p>

        



  </div>
<!-- NAV BAR END -->




<!--Start table -->

<div class="contentContainer">  
   
      <div class="tableContainer">  
        <div style="margin-left: 20px;">
                <button id="tab-pending" style="border: solid lightcoral">Pending</button>
                <button id="tab-completed" style="border: solid lightgreen">Completed</button>
            </div>
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



<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="Edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body"> 
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="saveButton" class="btn btn-primary">Save changes</button> 
        <button type="button" id="cancelButton" class="btn btn-primary">Cancel Order</button>
      </div>

    </div>
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
        editButton.type = "button"; 
        editButton.classList.add("btn", "boton");  
        editButton.setAttribute("data-bs-toggle", "modal");
        editButton.setAttribute("data-bs-target", "#editModal"); 

        editButton.setAttribute("data-orderid", booking.order_id);  
         editButton.addEventListener("click", () => {
      const orderID = booking.order_id;

      fetch("getOrderDetails.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "order_id=" + encodeURIComponent(orderID)
      })
      .then(response => response.json())
      .then(data => {
        console.log("Fetched order details:", data);
        
       
      const modalBody = document.querySelector("#editModal .modal-body");
modalBody.innerHTML = "";

if (data.length === 0) {
  modalBody.textContent = "No dishes found for this order.";
} else {
  const form = document.createElement("form");
  form.id = "orderEditForm";

  form.setAttribute("data-orderid", orderID);

  data.forEach((item, index) => {
    const formGroup = document.createElement("div");
    formGroup.classList.add("mb-3");

    const label = document.createElement("label");
    label.textContent = item.NAME || item.dish_name || "Unnamed Dish";
    label.setAttribute("for", `quantity-${index}`);
    label.classList.add("form-label");

    const input = document.createElement("input");
    input.type = "number";
    input.min = 1;
    input.name = `quantity_${item.dish_id}`;
    input.value = item.quantity;
    input.id = `quantity-${index}`;
    input.classList.add("form-control");

    formGroup.appendChild(label);
    formGroup.appendChild(input);
    form.appendChild(formGroup);
  });

  modalBody.appendChild(form);
}
      })
      .catch(error => {
        console.error("Error fetching order details:", error);
      });
    });


        row.appendChild(nameCell);
        row.appendChild(statusCell); 
        row.appendChild(editButton);
        tableBody.appendChild(row);

    });
  }  

  document.getElementById("saveButton").addEventListener("click", () => {
  const form = document.getElementById("orderEditForm");
  const formData = new FormData(form);
  
  const orderID = form.getAttribute("data-orderid");
  formData.append("order_id", orderID);

  fetch("updateOrderDetails.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(result => {
    if (result.success) {
      alert("Order updated successfully.");
      location.reload();
    } else {
      alert("Error: " + result.error);
    }
  })
  .catch(error => {
    console.error("Error updating order:", error);
    alert("An error occurred while saving.");
  });
}); 



document.getElementById("cancelButton").addEventListener("click", () => {
  const form = document.getElementById("orderEditForm");
  const orderID = form.getAttribute("data-orderid");

  if (!orderID) {
    alert("Order ID not found.");
    return;
  }

  if (!confirm("Are you sure you want to cancel this order?")) {
    return;
  }

  fetch("cancelOrder.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "order_id=" + encodeURIComponent(orderID)
  })
  .then(response => response.json())
  .then(result => {
    if (result.success) {
      alert("Order cancelled successfully.");
      location.reload();
    } else {
      alert("Error: " + result.error);
    }
  })
  .catch(error => {
    console.error("Error cancelling order:", error);
    alert("An error occurred while cancelling the order.");
  });
});




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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>
</html> 