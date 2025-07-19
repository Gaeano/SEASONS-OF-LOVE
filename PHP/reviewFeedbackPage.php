<?php 
    session_start();


  //   //if (isset($_SESSION['username']) && $_SESSION['UserType'] === 'admin') {
  //   header("Location: adminPage.php");
  //   exit();
  //  }

?>
<?php
include('connection.php');


$sql = "select * from contact order by name desc";
$result = mysqli_query($conn, $sql);

$contacts = [];


while ($row = mysqli_fetch_assoc($result)){
  $contacts[] = $row;
}

echo "<script> const contactData = " . json_encode($contacts). "</script>";


?>
<html>

<!DOCTYPE html>
<html lang = "en">
<head> 
    <meta charset="UTFs=8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    
    <link rel="stylesheet" href="../CSS/reviewFeedbackPage.css">
    


<!--For font for brand-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Glass+Antiqua&family=Marck+Script&display=swap" rel="stylesheet">



    <title>Customer Feedback</title>

    <style>
      .container-fluid{
        font-family: "Marck Script", cursive;
        font-weight: 400;
        font-style: normal;

      }

      body{
     background-image: url(../IMAGES/log_in_bg.jpg);
    background-repeat:no-repeat ;
    background-position: center;
    background-size: cover;
      background-attachment: fixed;
    
    margin: 0;
  padding: 0;

  height: 100vh;
  width: auto;
  z-index: -1;
      }
/* }



#container{
    margin: 8%;
    padding: 10px;
    background-color: #fff9dc;
}

.contentContainer{
    margin-bottom: 20px;
    padding: 15px;
   background-color: #fff9dc;
    border-radius: 10px;
    
}*/

#customerFeedbackForm{
    padding: 10px;
    border-radius: 6px;
}
 


#container {
  max-width: 900px;
  margin: 0 auto;
  padding: 40px 20px;
  background-color: #fff9dc;

  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);

  margin-top:50px;
  height:auto;
}

h2 {
  text-align: center;
  font-size: 28px;
  margin-bottom: 20px;
  font-weight: bold;
  color: #333;
  text-transform: uppercase;
}
 


.contentContainer {
  background-color: #ffffff;
  border-radius: 10px;
  padding: 20px 25px;
  margin-bottom: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.contentContainer:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
}


.name {
  font-size: 20px;
  color: #333;
  margin-bottom: 5px;
    font-weight: bold;
margin-bottom: 10px;
    text-transform: uppercase;
}


.email {
  font-size: 15px;
  color: #777;
  margin-bottom: 5px;
}


.date {
  font-size: 15px;
  color: #aaa;
  margin-bottom: 12px;
}


#message {
  font-size: 18px;
  line-height: 1.6;
  color: #444;
  text-align: justify;
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
        



         <a id="linkSide" href="employeePage.php" target="_self"> MANAGE BOOKINGS </a>
          <a id="linkSide" href=".empManagementPage.html" target="_self"> MANAGE MENU </a>
          <a id="linkSide" href="../PHP/reviewFeedbackPage.php" target="_self"> CUSTOMER FEEDBACK </a>
          <a id="linkSide" href="../PHP/adminPage.php" target="_self"> ADMIN </a>
          <a id="linkSide" href="logout.php" target="_self"> LOGOUT </a>




        </nav>

        <nav class="menu">
          <div class="menuLeft">
     
          </div>
          <div>

          <a class="hideOnMobile" id="reserve" href="../HTML/employeePage.php" target="_self"> MANAGE BOOKINGS </a>

          <a class="hideOnMobile" id="reserve" href="../HTML/empManagementPage.html" target="_self"> MANAGE MENU </a>
          <a class="hideOnMobile" id="reserve" href="reviewFeedbackPage.php" target="_self"> CUSTOMER FEEDBACK </a>
          <a class="hideOnMobile" id="reserve" href="adminPage.php" target="_self"> ADMIN </a>
          <a class="hideOnMobile" id="reserve" href="logout.php" target="_self"> LOGOUT </a>



          </div>
        </nav>



        <p id="menuButton" onclick= openSideBar()> <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> </p>

  </div>
<!-- NAV BAR END -->



<div id="container">
  <h2 style="text-align: center;"> Customer Feedback </h2>
<div id="customerFeedbackForm">

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

      console.log(contactData);
      const masterContainer = document.getElementById("customerFeedbackForm");
      let count = 0;

      contactData.forEach(contact => {
        const container = document.createElement("div");
        container.classList.add("contentContainer");

        const name = document.createElement("h3");
        name.classList.add("name");
        name.setAttribute("id", "user_name");
        name.textContent = contact.name;

        const email = document.createElement("h5");
        email.classList.add("email")
        email.setAttribute("id", "user_email");
        email.textContent = contact.email;

        const date = document.createElement("h6");
        date.classList.add("date");
        date.setAttribute("id", "date_sent");
        date.textContent = contact.msgdate;

        const message = document.createElement("p");
         const hr = document.createElement("hr");
        message.setAttribute("id", "message");
        message.textContent = contact.message;
        message.style.textAlign = "justify"

        container.appendChild(name);
        container.appendChild(email);
        container.appendChild(date);
        container.appendChild(hr);
        container.appendChild(message);
        masterContainer.appendChild(container);
        count++;

      });

      if(count > 2){
        masterContainer.style.maxHeight = "500px";
        masterContainer.style.overflowY =  "scroll";
      }
  


</script>
</body>

</html>