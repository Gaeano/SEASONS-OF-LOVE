<?php
  include('../PHP/connection.php');




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
<html>
<head>
    <meta charset="utf=8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="stylesheet" href="../CSS/empManagement.css">


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
          <a id="linkSide" href="logout.php" target="_self"> LOGOUT </a>

        </nav>

        <nav class="menu">
          <div class="menuLeft">
     
          </div>
          <div>


          <a class="hideOnMobile" id="reserve" href="employeePage.php" target="_self"> MANAGE BOOKINGS </a>
          <a class="hideOnMobile" id="reserve" href="empManagementPage.php" target="_self"> MANAGE MENU </a>
          <a class="hideOnMobile" id="reserve" href="../PHP/reviewFeedbackPage.php" target="_self"> CUSTOMER FEEDBACK </a>
          <a class="hideOnMobile" id="reserve" href="../PHP/adminPage.php" target="_self"> ADMIN </a>
          <a class="hideOnMobile" id="reserve" href="logout.php" target="_self"> LOGOUT </a>
          
          </div>
        </nav>



        <p id="menuButton" onclick= openSideBar()> <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> </p>

  </div>
<!-- NAV BAR END -->

<div class="mainContainer">  
   
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
</script> 





<script> 

const menuData = menuFromPHP;
const MenuButtons = document.getElementById("menuPage");  

const rowPerPage = 5; 



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


//PAGINATION HIGHLIGHTS WHEN ITS ON THAT PAGE
const pageButtons = document.querySelectorAll('.menuPages button');

  pageButtons.forEach(button => {
    button.addEventListener('click', () => {
      
      pageButtons.forEach(btn => btn.classList.remove('active'));
     
      button.classList.add('active');

     
      const pageNum = button.textContent;
      console.log("Go to page:", pageNum);
    });
  });


</script>









</body>


</html>