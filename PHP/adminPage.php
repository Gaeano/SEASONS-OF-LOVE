
<!DOCTYPE html>
<html lang = "en">
<head> 
    <meta charset="utf=8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="stylesheet" href="../CSS/adminPage.css">


<!--For font for brand-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Glass+Antiqua&family=Marck+Script&display=swap" rel="stylesheet">



    <title>Seasons Of Love</title>

    <style>
      .container-fluid{
        font-family: "Marck Script", cursive;
        font-weight: 400;
        font-style: normal;
  }

    </style>






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
        

          <a id="linkSide" href="HTML/gallery.html" target="_self"> USERS </a>

        </nav>

        <nav class="menu">
          <div class="menuLeft">
     
          </div>
          <div>
          <a class="hideOnMobile" id="reserve" href="HTML/reserve date.html" target="_self"> USERS </a>

          </div>
        </nav>



        <p id="menuButton" onclick= openSideBar()> <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> </p>

  </div>
<!-- NAV BAR END -->

<div class="contentContainer"> 
    <div class="tableContainer"> 
      <div id="menuTitle">
        <h2>MENU</h2>
        </div>

        <table id="myTable">
          <thead>
            <tr>
              
              <th>Product Name</th>
              <th>Status</th>
              <th>Edit</th>
            </tr>

          </thead>
          <tbody>
            <!-- insert rows -->
          </tbody>

        </table>

    </div>


    <div class="userContainer">
      <h2 style="text-align: center;">USERS</h2>
      <div class="userTable">
        <table id="tableEmp">
            <thead>
              <tr>
                <th id="emp">Employee</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <table id="tableCustomer">
          <thead>
            <tr>
              <th id="cust">Customer</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
    </div>

</div>
    
   



   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
      const data = [
    { name: "Alice"},
    { name: "Bob"},
    { name: "Charlie"}
];

// Get the table body element
const tableBody = document.querySelector("#tableEmp tbody");

// Iterate over the data and create table rows
data.forEach(item => {
    // Create a new table row
    const row = document.createElement("tr");

    // Create table data cells for each property
    const nameCell = document.createElement("td");
    nameCell.textContent = item.name;
    row.appendChild(nameCell);


    // Append the row to the table body
    tableBody.appendChild(row);
});

const dataz = [
    { name: "Alice"},
    { name: "Bob"},
    { name: "Charlie"}
];

const tableBodi = document.querySelector("#tableCustomer tbody");

// Iterate over the data and create table rows
dataz.forEach(item => {
    // Create a new table row
    const row = document.createElement("tr");

    // Create table data cells for each property
    const nameCell = document.createElement("td");
    nameCell.textContent = item.name;
    row.appendChild(nameCell);


    // Append the row to the table body
    tableBodi.appendChild(row);
});
      </script> 

</body>


</html>