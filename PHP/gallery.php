
<?php
include('connection.php');

$sql = "SELECT image_path, NAME, description, category FROM dishes where isAvailable = 1";
$result = mysqli_query($conn, $sql);

$dishes = [];
while ($row = mysqli_fetch_assoc($result)) {
  $dishes[] = $row;
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Gallery</title>
  

  <meta charset="utf=8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="../CSS/gallery.css">

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


<!-- GALLERY-->
    <div class="gallery-container">
    
    <div class="main-gallery">
        <div class="slide-wrapper">
            <button class="nav-arrow prev" onclick="changeImage(-1)"><</button>
            
            <div class="slide-container" id="slideContainer">
                <img id="mainImage" src="../IMAGES/gallery_1.jpg" alt="Gallery Image">
                <div class="image-caption" id="mainCaption">Beautiful Wedding Moment</div>
            </div>  
            
            <button class="nav-arrow next" onclick="changeImage(1)">></button>
        </div>
    </div>
    
    <div class="thumbnail-strip">
        <div class="thumbnail active" onclick="showImage(0)">
            <img src="../IMAGES/gallery_1.jpg" alt="Thumbnail 1">
        </div>
        <div class="thumbnail" onclick="showImage(1)">
            <img src="../IMAGES/gallery_2.jpg" alt="Thumbnail 2">
        </div>
        <div class="thumbnail" onclick="showImage(2)">
            <img src="../IMAGES/gallery_3.jpg" alt="Thumbnail 3">
        </div>
        <div class="thumbnail" onclick="showImage(3)">
            <img src="../IMAGES/gallery_4.jpg" alt="Thumbnail 4">
        </div>
    </div>
</div>





<div class="mother">


<div class="info">
<center>
   <h4>MENU</h4>

 </center>

</div>


<!-- search bar -->

<div class="filter-bar">
    <!-- search bar -->
<div class="searchBar">
      <input type="text" id="searchInput" placeholder="Search dish..." />
      <button class="search-btn">
        <svg class="search-icon" viewBox="0 0 24 24">
          <path d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
        </svg>
      </button>
    </div>

    <!-- category -->
    <div class="productCategory">
  
      <select id="categoryFilter">
        <option value="all">All Categories</option>
        <option value="Beef">Beef</option>
        <option value="Chicken">Chicken</option>
        <option value="Pork">Pork</option>
        <option value="Fish & Seafood">Fish & Seafood</option>
        <option value="Noodles & Pasta">Noodles & Pasta</option>
        <option value="Salads & Deserts">Salads & Deserts</option>
      </select>

    </div>
    

  </div>



<div class="productsGrid" id="dishContainer"></div>


























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
















const dishes = <?php echo json_encode($dishes);?>;
// const rowsPerPage = 6;
// let currentPage = 1;
let filteredDishes = dishes;




function renderDishes() {
  const container = document.getElementById('dishContainer');
  container.innerHTML = '';

  filteredDishes.forEach(dish => {
    const div = document.createElement('div');
    div.className = 'product';
    div.innerHTML = `
      <img src="${dish.image_path.trim()}" alt="${dish.NAME}" style="width:100%; height:160px; object-fit:cover;" />
      <div class="product_content">
        <h2>${dish.NAME}</h2>
        <p3>${dish.category}</p3>
        <p>${dish.description}</p>
    
      </div>
    `;
    container.appendChild(div);
  });
}
function filterDishes() {
  const searchVal = document.getElementById('searchInput').value.toLowerCase();
  const categoryVal = document.getElementById('categoryFilter').value;

  filteredDishes = dishes.filter(dish => {
    const matchesSearch = dish.NAME.toLowerCase().includes(searchVal);
    const matchesCategory = categoryVal === 'all' || dish.category === categoryVal;
    return matchesSearch && matchesCategory;
  });

  renderDishes();
}

document.getElementById('searchInput').addEventListener('input', filterDishes);
document.getElementById('categoryFilter').addEventListener('change', filterDishes);



//FORDA GALLERY

const images = [
    { src: "../IMAGES/gallery_1.jpg", caption: "Floral fantasy meets gourmet catering" },
    { src: "../IMAGES/gallery_2.jpg", caption: "Full-service catering for grand and elegant celebrations" },
    { src: "../IMAGES/gallery_3.jpg", caption: "Elegant buffet setup for your special events." },
    { src: "../IMAGES/gallery_4.jpg", caption: "Stylish sandwich and dessert spread by our catering team" }
];
    //add photos by just copy pasting the line above and its corresponding div in the html
    //gallery1-4 rn are all still placeholder photos when replacing just name the new photos as gallery 1-4

let currentIndex = 0;
let currentImage = new Image();


document.addEventListener('DOMContentLoaded', function() {
    
    currentImage.onload = function() {
        updateMainImage();
        adjustSlideSize();
    };
    currentImage.src = images[0].src;

    window.addEventListener('resize', adjustSlideSize);
});

function adjustSlideSize() {
    const slideContainer = document.getElementById('slideContainer');
    const mainImage = document.getElementById('mainImage');
    
    slideContainer.style.width = 'auto';
    slideContainer.style.height = 'auto';
    mainImage.style.maxHeight = '50vh';
    mainImage.style.maxWidth = '100%';
    
    const maxContainerWidth = window.innerWidth * 0.8;
    const maxContainerHeight = window.innerHeight * 0.55;
    
    const imgRatio = mainImage.naturalWidth / mainImage.naturalHeight;
    
    let displayWidth = mainImage.naturalWidth;
    let displayHeight = mainImage.naturalHeight;
    
    if (displayWidth > maxContainerWidth) {
        displayWidth = maxContainerWidth;
        displayHeight = displayWidth / imgRatio;
    }
    
    if (displayHeight > maxContainerHeight) {
        displayHeight = maxContainerHeight;
        displayWidth = displayHeight * imgRatio;
    }
    
    slideContainer.style.width = `${displayWidth}px`;
    slideContainer.style.height = `${displayHeight}px`;
    mainImage.style.width = `${displayWidth}px`;
    mainImage.style.height = `${displayHeight}px`;
}

function preloadImage(src, callback) {
    currentImage.onload = function() {
        callback();
        currentImage.onload = null;
    };
    currentImage.src = src;
}

function showImage(index) {
    currentIndex = index;
    preloadImage(images[currentIndex].src, function() {
        updateMainImage();
        adjustSlideSize();
    });
    updateThumbnails();
}

renderDishes();











</script>

</body>
</html>





