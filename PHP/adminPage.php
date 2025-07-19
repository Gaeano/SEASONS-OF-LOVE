<?php 
    session_start();


   if (!isset($_SESSION['UserType']) || $_SESSION['UserType'] !== 'admin') {
    header("Location:../HTML/reserve date.html");
    exit();
    }

?>

<?php
  include('connection.php');




  $sql = "Select userID, username, UserType from login";


  $result = mysqli_query($conn, $sql);

  $users = []; //initialize users as an array

  while ($row = mysqli_fetch_assoc($result)){  //put the results inside the array
      $users[] = $row;
  }

  echo "<script>const usersFromPHP = " . json_encode($users).";</script>"; 

  $sqlMenu = "SELECT dish_id, NAME, category, image_path, description FROM dishes";
  $resultMenu = mysqli_query($conn, $sqlMenu);

  $menu = [];
  while ($row = mysqli_fetch_assoc($resultMenu)) {
    $menu[] = $row;
  }
  echo "<script>const menuFromPHP = " . json_encode($menu) . ";</script>";

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
                    header("Location: adminPage.php");
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




<!DOCTYPE html>
<html lang = "en">
<head> 
    <meta charset="UTFs=8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="stylesheet" href="../CSS/adminpage.css">


<!--For font for brand-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Glass+Antiqua&family=Marck+Script&display=swap" rel="stylesheet">



    <title>Admin Page</title>

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
        


          <a id="linkSide" href="../HTML/employeePage.php" target="_self"> MANAGE BOOKINGS </a>
          <a id="linkSide" href="empManagementPage.php" target="_self"> MANAGE MENU </a>
          <a id="linkSide" href="reviewFeedbackPage.php" target="_self"> CUSTOMER FEEDBACK </a>
          <a id="linkSide" href="adminPage.php" target="_self"> ADMIN </a>


        </nav>

        <nav class="menu">
          <div class="menuLeft">
     
          </div>
          <div>

          <a class="hideOnMobile" id="reserve" href="../HTML/employeePage.php" target="_self"> MANAGE BOOKINGS </a>
          <a class="hideOnMobile" id="reserve" href="../PHP/empManagementPage.php" target="_self"> MANAGE MENU </a>
          <a class="hideOnMobile" id="reserve" href="../PHP/reviewFeedbackPage.php" target="_self"> CUSTOMER FEEDBACK </a>
          <a class="hideOnMobile" id="reserve" href="adminPage.php" target="_self"> ADMIN </a>
          


          </div>
        </nav>



        <p id="nextPage" onclick= openSideBar()> <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> </p>

  </div>
<!-- NAV BAR END -->

<div class="contentContainer"> 
  <div class="menuContainer">  
   
      
        <div id="menuTitle">
          <h2>Menu</h2>
          </div>

          <table id="menuTable">
            <thead>
              <tr>
                
                <th class="dishdish">Dish</th>
                <th class="catcat">Category</th> 
                <th>Description</th> 
                <th class="editedit">Edit</th> 
                
              </tr>

            </thead>
            <tbody>
              <!-- insert rows -->
            </tbody>

          </table> 
          <div id="menuPage" class="menuPages"></div>

   
 </div> 

 <div class="beside">
  <div class="userContainer">
        <h2>USERS</h2>
        <div class="userTable">
          <div class="employeeTable">
            <table id="tableEmp">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th id="emp">Employee</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div id="empPagination" class="pagination"></div>
          </div>
            
        <div class="customerTable">
          <table id="tableCustomer">
            <thead>
              <tr>
                <th>ID</th>
                <th id="cust">Customer</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
          <div id="custPagination" class="pagination"></div>
      </div>
    </div>
    
  </div>


<div class="userCrudContainer">
  <div class="accountCrudTable">
    <div id ="buttons">
        <button id="employeeButton" style="margin-left:20px;"> Employee </button>
        <button id="customerButton"> Customer </button>
        <button id="createEmp"> Create Employee Account </button>
    </div>

    <table class=tbl>
      <thead>
        <tr>
          <th>ID</th>
          <th> Name </th>
          <th  id="actions"> Actions </th>
        </tr>
      </thead>
      
      <tbody>

      </tbody>
    </table>
  
    <div id="nextPage"></div>


  </div> 

</div>


 </div>




    
</div>


  <div id="form">
    <div id="modal-content">
        <!-- <h1 id="heading">SignUp Form</h1> -->
        <h2> Employee Sign Up</h2>  
        <form name="form" action="signup.php" method="POST">
            <label>Enter Username: </label>
            <input type="text" id="user" name="user" required><br><br>
            <label>Enter Email: </label>
            <input type="email" id="email" name="email" required><br><br>
            <label>Create Password: </label>
            <input type="password" id="pass" name="pass" required><br><br>
            <label>Retype Password: </label>
            <input type="password" id="cpass" name="cpass" required><br><br>
            <input type="submit" id="btnYES" class="signUpButton" value="SignUp" name = "submit"/>
            <button class="button" id="buttonz">Cancel</button>
            <!-- <p id="confirm">Account Successfully Created</p> -->
        </form>
      </div>
    </div>

<div id="formEdit">
  <div id="modal-content-edit">
    <h2 id="heading">Edit Form</h2>
    <form name="form" id="editFrm" method="POST">
        <label>Edit Name: </label>
        <input type="text" id="username" name="username" required><br><br>
        <input type="submit" id="btn" class="delButton" value="Edit" name = "submit"/>
        <button id="cancelButton" class="editButton">Cancel</button>
    </form>
  </div>
</div> 




<div class="modal fade" id="menuModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Dish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer"> 

        <button type="submit" form="dishEditForm" class="btn btn-success">Save</button> 
        <button type="button" class="btn btn-secondary" id="availabilityToggle" onclick="toggleAvailability(this)" data-dishid="">Change Availability</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div id="deleteConfirm"> 
  <div id= "deleteContent">
    <h3> Are you sure you want to delete this user? </h3>
    <h4> Warning: This action cannot be undone! </h4>
    <div class="bubu">
       <button id="confirmDeletion"> Delete </button>
    <button id="cancelDeletion"> Cancel </button>
    </div>

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



// pagination
const tableEmployee = document.querySelector("#tableEmp tbody");
const tableCustomer = document.querySelector("#tableCustomer tbody");

const employeeData = usersFromPHP.filter(user => user.UserType === "employee");
const customerData = usersFromPHP.filter(user => user.UserType === "customer");
const menuData = menuFromPHP; 


const rowPerPage = 5;

function pagination (data, tableBody, page){
    tableBody.innerHTML = "";


  const start = (page - 1) * rowPerPage;
  const end = start + rowPerPage;
  const pageData = data.slice(start, end);

    pageData.forEach(user => {
        const row = document.createElement("tr");
        row.addClass //?
        const userID = document.createElement("td");

        userID.textContent = user.userid;
        

        const nameCell = document.createElement("td");
        nameCell.textContent = user.username;
        row.appendChild(userID);
        row.appendChild(nameCell);
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


  pagination(employeeData, tableEmployee, 1);
  pagination(customerData, tableCustomer, 1);

  pageControls("empPagination", employeeData, tableEmployee);
  pageControls("custPagination", customerData, tableCustomer);
    
    // end of pagination

    // start of accounts pagination
    
const tblBody = document.querySelector(".tbl tbody");
const users = usersFromPHP;
const buttonContainers = document.getElementById("nextPage");
const MenuButtons = document.getElementById("menuPage")
const employeeButton = document.getElementById("employeeButton");
const customerButton = document.getElementById("customerButton");


const rowsPerPage = 5;
let currentData =  usersFromPHP.filter(u => u.UserType === "employee");
let currentPage = 1;

function paginate (data, page){
    tblBody.innerHTML = "";


  const start = (page - 1) * rowsPerPage;
  const end = start + rowsPerPage;
  const pageData = data.slice(start, end);

    pageData.forEach(user => {
        const rows = document.createElement("tr");
        rows.classList.add("rowz")

        const userID = document.createElement("td");

        userID.textContent = user.userid;

        userID.classList.add("userIDCol")

        const nameCellz = document.createElement("td");
        nameCellz.textContent = user.username;
        nameCellz.classList.add("nameCol")
    

        const editDel = document.createElement("td");
        editDel.innerHTML = `

          <button class ="editButton" data-id= ${user.userid}>Edit</button>
          <button class="delButton" data-id=${user.userid}>Delete</button>`;

        editDel.classList.add("table3Data")
        rows.appendChild(userID);
        rows.appendChild(nameCellz);
        rows.appendChild(editDel);
        tblBody.appendChild(rows);

    });

    addEventListeners();
} 

function controlz (container, data){
  container.innerHTML = "";
  const totalPagesz = Math.ceil (data.length / rowsPerPage);

  for (let i = 1; i <= totalPagesz; i++){
    const btnz = document.createElement("button");
    btnz.textContent = i;
    btnz.classList.add ("page-btn");
    btnz.addEventListener("click", () => {
      currentPage = i;
      paginate(data, currentPage);
    });
    container.appendChild(btnz);
  }
}

function addEventListeners(){
  const editButton = document.querySelectorAll(".editButton");
  const formEdit = document.getElementById("formEdit");
  const editFrm = document.getElementById("editFrm");
  const cancelButton = formEdit.querySelector("#cancelButton");
  const usernameInput = document.getElementById("username");

  editButton.forEach(btn => {
    btn.addEventListener("click", ()=> {
      const userId = btn.getAttribute("data-id");


      const userToEdit = users.find(user=>user.userID == userId);

      usernameInput.value = userToEdit.username;
      editFrm.action = `update_page_1.php?id=${userId}`;


      formEdit.style.display = "flex";
    });
  }); 

  const confirmButton = document.getElementById("confirmDeletion");
  const deleteButton = document.querySelectorAll(".delButton");
  const deleteForm = document.getElementById("deleteConfirm");
  const cancelDeletion = document.getElementById("cancelDeletion");


  cancelDeletion.onclick =function(){
    deleteForm.style.display = "none";
  };


  deleteButton.forEach(btn =>{
    btn.addEventListener("click", () => {
      const userId = btn.getAttribute("data-id");
      deleteForm.style.display = "Flex";
      confirmButton.setAttribute("data-id", userId);
    });
  });

  confirmButton.addEventListener("click", ()=> {
    const userId = confirmButton.getAttribute("data-id");
    window.location.href = `delete_page_1.php?id=${userId}`;
  })


window.addEventListener("click", function(event){
  if(event.target == formEdit){
    formEdit.style.display = "none";
  }
});

cancelButton.onclick = function(){
  formEdit.style.display = "none";
}


}


function showData(userType){
  currentData = users.filter(user => user.UserType === UserType);
  currentPage = 1;
  paginate (currentData, currentPage);
  controlz(buttonContainers, currentData);
}



  paginate(currentData, currentPage);
  controlz(buttonContainers, currentData);

  employeeButton.addEventListener("click", () => showData("employee"));
  customerButton.addEventListener("click", () => showData("customer"));

// // end of accoouns pagination


  const modal = document.getElementById("form");

  createEmp.addEventListener("click", () => modal.style.display = 'flex');
  const btn = document.getElementById("buttonz");

  btn.onclick = function(){
    alert("Account Successfully created");
  }

btn.onclick = function(){
  modal.style.display = "none";
}

window.onclick = function(event){
  if(event.target == modal){
    modal.style.display = "none";
  }
} 
 


const menuTable = document.querySelector("#menuTable tbody");

function menuControls (containerId, data, tableBody){
  const container = document.getElementById(containerId);
  container.innerHTML = "";

  const totalPages = Math.ceil (data.length / rowPerPage);
  
  for (let i = 1; i <= totalPages; i++){
    const btn = document.createElement("button");
    btn.textContent = i;
    btn.classList.add ("page-btn");
    btn.addEventListener("click", () => menuPages(data, tableBody, i));
    container.appendChild(btn);
  }
  }
 
function menuPages(data, tableBody, page) {
  tableBody.innerHTML = "";

  const start = (page - 1) * rowPerPage;
  const end = start + rowPerPage;
  const pageData = data.slice(start, end);

  pageData.forEach(dish => {
    const row = document.createElement("tr");

    const nameCell = document.createElement("td");
    const categoryCell = document.createElement("td");  
    const descriptionCell = document.createElement("td");
    const editButton = document.createElement("button");

    nameCell.textContent = dish.NAME || "Unnamed Dish";
    categoryCell.textContent = dish.category || "Uncategorized"; 
    descriptionCell.textContent = dish.description || "No Description"; 

    editButton.textContent = "Edit";
    editButton.type = "button";
    editButton.classList.add("btn", "boton");
    editButton.setAttribute("data-bs-toggle", "modal");
    editButton.setAttribute("data-bs-target", "#menuModal");
    editButton.setAttribute("data-dishid", dish.dish_id);

    editButton.addEventListener("click", () => { 
      const modalBody = document.querySelector("#menuModal .modal-body");
      modalBody.innerHTML = "";

      const form = document.createElement("form");
      form.id = "dishEditForm";
      form.setAttribute("data-dishid", dish.dish_id); 

 
      form.action = `update_dish.php?id=${dish.dish_id}`; 
      form.method = "POST";

      // Dish Name
      const nameGroup = document.createElement("div");
      nameGroup.classList.add("mb-3");
      const nameLabel = document.createElement("label");
      nameLabel.textContent = "Dish Name";
      nameLabel.setAttribute("for", "dishName");
      nameLabel.classList.add("form-label");
      const nameInput = document.createElement("input");
      nameInput.type = "text";
      nameInput.name = "name";
      nameInput.value = dish.NAME || "";
      nameInput.id = "dishName";
      nameInput.classList.add("form-control");
      nameGroup.appendChild(nameLabel);
      nameGroup.appendChild(nameInput);

      // Category
      const categoryGroup = document.createElement("div");
      categoryGroup.classList.add("mb-3");
      const categoryLabel = document.createElement("label");
      categoryLabel.textContent = "Category";
      categoryLabel.setAttribute("for", "dishCategory");
      categoryLabel.classList.add("form-label");
      const categoryInput = document.createElement("input");
      categoryInput.type = "text";
      categoryInput.name = "category";
      categoryInput.value = dish.category || "";
      categoryInput.id = "dishCategory";
      categoryInput.classList.add("form-control");
      categoryGroup.appendChild(categoryLabel);
      categoryGroup.appendChild(categoryInput);

      // Image Path
      const imageGroup = document.createElement("div");
      imageGroup.classList.add("mb-3");
      const imageLabel = document.createElement("label");
      imageLabel.textContent = "Image Path";
      imageLabel.setAttribute("for", "dishImage");
      imageLabel.classList.add("form-label");
      const imageInput = document.createElement("input");
      imageInput.type = "text";
      imageInput.name = "image_path";
      imageInput.value = dish.image_path || "";
      imageInput.id = "dishImage";
      imageInput.classList.add("form-control");
      imageGroup.appendChild(imageLabel);
      imageGroup.appendChild(imageInput); 

      // Description
    const descriptionGroup = document.createElement("div");
    descriptionGroup.classList.add("mb-3");
    const descriptionLabel = document.createElement("label");
    descriptionLabel.textContent = "Description";
    descriptionLabel.setAttribute("for", "dishDescription");
    descriptionLabel.classList.add("form-label");
    const descriptionInput = document.createElement("textarea");
    descriptionInput.name = "description";
    descriptionInput.value = dish.description || "";
    descriptionInput.id = "dishDescription";
    descriptionInput.classList.add("form-control");
    descriptionGroup.appendChild(descriptionLabel);
    descriptionGroup.appendChild(descriptionInput);

      // Append all to form
      form.appendChild(nameGroup);
      form.appendChild(categoryGroup);
      form.appendChild(imageGroup);
      form.appendChild(descriptionGroup);
      modalBody.appendChild(form); 

      document.getElementById("availabilityToggle").setAttribute("data-dishid", dish.dish_id);
    });

    row.appendChild(nameCell);
    row.appendChild(categoryCell); 
    row.appendChild(descriptionCell);
    row.appendChild(editButton);
    tableBody.appendChild(row);
  });
} 

menuControls("menuPage", menuData, menuTable);
menuPages(menuData, menuTable, 1);

</script> 
 
<script>
function toggleAvailability(button) {
    const dish_id = button.getAttribute('data-dishid');  

  if (!dish_id) {
    alert("No dish ID found.");
    return;
  }

   if (!confirm("Are you sure you want to change this item's availability?")) {
        return; 
    }
    

    fetch('toggle_availability.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `dish_id=${encodeURIComponent(dish_id)}`
    })
    .then(response => response.text())
    .then(data => {
        alert(data); 
        location.reload(); 
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>


</html>