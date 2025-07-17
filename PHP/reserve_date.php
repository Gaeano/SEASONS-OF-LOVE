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
  <title>Reserve a Date</title>
  <style>
    /* .productsGrid { display: flex; flex-wrap: wrap; gap: 20px; }
    .product { border: 1px solid #ccc; width: 250px; padding: 10px; position: relative; }
    .highlight { border: 2px solid green; background: #eaffea; }
    .cart { position: fixed; top: 20px; right: 20px; border: 1px solid #000; padding: 10px; width: 200px; background: #fff; }
    .pagination { margin-top: 20px; }
    .pagination button { margin: 0 5px; } */
    
  </style>

  <meta charset="utf=8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="reserve date.css">

  <!--For font for brand-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Glass+Antiqua&family=Marck+Script&display=swap" rel="stylesheet">

  <title>Reserve a Date</title>

</head>



<body>

<!-- NAV BAR START -->
<div id="bgimg"> </div>


    <div class="navBar">
              
  

      <div class="navLogo">
        <a href="../index.html">
           <img id="brandlogo" src="../IMAGES/logo3.png" alt="Logo">  
        </a>
       
      </div>
      
        <nav class="sideBar">

          <a id="closeBtn" onclick=hideSideBar()> <svg xmlns="http://www.w3.org/2000/svg" height="27px" viewBox="0 -960 960 960" width="27px" fill="black"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a>
        
          <a id="linkSide" href="../index.html" target="_self"> HOME </a>

          <a id="linkSide" href="../HTML/gallery.html" target="_self"> GALLERY </a>

          <a id="linkSide" href="../HTML/about company.html" target="_self"> COMPANY </a>

          <a id="linkSide" href="../HTML/contact.html" target="_self"> CONTACT US </a>

          <a id="linkSide" href="" target="_self"> BOOKINGS </a>

          <a id="linkSide" href="reserve date.php" target="_self"> RESERVE A DATE </a>

        </nav>

        <nav class="menu">
          <div class="menuLeft">
          <a class="hideOnMobile" href="../index.html" target="_self"> HOME </a>

          <a class="hideOnMobile" href="../HTML/gallery.html" target="_self"> GALLERY </a></button>

          <a class="hideOnMobile" href="../HTML/about company.html" target="_self"> COMPANY </a>

          <a class="hideOnMobile" href="../HTML/contact.html" target="_self"> CONTACT US </a>

          <a id="hideOnMobile" href="" target="_self"> BOOKINGS </a>

          </div>
          <div>
          <a class="hideOnMobile" href="reserve date.php" id="reserve" target="_self"> RESERVE A DATE </a>
          </div>
        </nav>
       

        
        <p id="menuButton" onclick= openSideBar()> <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> </p>

        



  </div>
<!-- NAV BAR END -->

  <div class="the-title">
    <h1>Seasons of Love</h1>

  </div>











  <div class="calendar">
  <center style="margin-bottom: 20px;">
    <p2>Reserve a Date for Seasons of Love Catering Services!<br></p2>
    <p2>Please Select a Date when we can serve you! Choose wisely and considerably. Seasons of Love might be busy in
      days highlighted as red in the given calendar below! Please reserve a more suitable date!</p2>
  </center>

  <div class="month" style="display: flex; justify-content: center; align-items: center; gap: 1rem;">
    <button id="prevMonth">&lt</button>
    <h2 id="calendar-month">January</h2>
    <h2 id="calendar-year">2025</h2>
    <button id="nextMonth">&gt</button>
  </div>

  <div id="calendar" class="calendar-grid"></div>
</div>


  <div class="mother">



    <center>

      <h3><hr><b>MENU</b><hr></h3>

      <p2 id="p2">pick and choose as many authentic Filipino dishes to your liking</p2>

    </center>



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
    
    <!-- <button class="cart-btn">Cart</button> -->
  </div>



<aside class="cart" id="cart">
  <div class="cart-header">
    <h2>Cart</h2>
    <span class="cart-count" id="cartCount">0</span>
  </div>
  <ul id="cartList"></ul>
   <!-- <form method="POST" action="checkout.php">
    <input type="hidden" name="orderData" id="orderDataField">
    <button class="checkout-btn" type="submit" onclick="prepareCheckoutData()">Checkout</button>
  </form> -->

  <!-- <form method="POST" action="checkout.php">
  <input type="hidden" name="orderData" id="orderDataField">
  <input type="hidden" name="selectedDate" id="selectedDateField">
  <button class="checkout-btn" type="submit" onsubmit="prepareCheckoutData()">Checkout</button>
  <form method="POST" action="checkout.php" onsubmit="return prepareCheckoutData()">
    <button type="submit">Checkout</button>
</form>
</form> -->

<form method="POST" action="checkout.php" onsubmit="prepareCheckoutData()">
  <input type="hidden" name="orderData" id="orderDataField">
  <input type="hidden" name="selectedDate" id="selectedDateField">
  <button class = "checkout-btn" type="submit">Checkout</button>
</form>






</aside>

<!-- <aside class="cart-sidebar">
    <h3>Your Cart</h3>
    <div class="cart-items"> -->
      <!-- Cart items will be added here -->
    <!-- </div>
    <button class="checkout-btn">Checkout</button>
  </aside> -->



<div class="productsGrid" id="dishContainer"></div>




<!-- CONFIRMATION LETTER CHECKOUT MODAL TYPE SHIIIII -->























<script>
const dishes = <?php echo json_encode($dishes);?>;
const rowsPerPage = 6;
let currentPage = 1;
let filteredDishes = dishes;
let cart = [];
let selectedDate = null;


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
    
        <button onclick="addToCart('${dish.NAME}')">Order</button>
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

function addToCart(dishName) {
  const existing = cart.find(item => item.name === dishName);
  if (existing) {
    existing.qty++;
  } else {
    cart.push({ name: dishName, qty: 1 });
  }
  renderCart();
}

//THE INCREASE DECREASE THINGY
function increaseQty(dishName) {
  const item = cart.find(i => i.name === dishName);
  if (item) {
    item.qty++;
    renderCart();
  }
}

function decreaseQty(dishName) {
  const item = cart.find(i => i.name === dishName);
  if (item && item.qty > 1) {
    item.qty--;
  } else {
    cart = cart.filter(i => i.name !== dishName);
  }
  renderCart();
}



function renderCart() {
  const cartList = document.getElementById('cartList');
  const cartCount = document.getElementById('cartCount');
  cartList.innerHTML = '';
  let totalCount = 0;

  cart.forEach(item => {
    const li = document.createElement('li');
    li.innerHTML = `
      <span class = "cartProductList">${item.name}</span>
      <div class="cart-item-controls">
        <button onclick="decreaseQty('${item.name}')">-</button>
        <span>${item.qty}</span>
        <button onclick="increaseQty('${item.name}')">+</button>
      </div>
    `;
    cartList.appendChild(li);
    totalCount += item.qty;
  });

  cartCount.textContent = totalCount;
}











function prepareCheckoutData() {
  // const field = document.getElementById('orderDataField');
  // const dateField = document.getElementById('selectedDateField');
  // const convertedCart = cart.map(item => ({ name: item.name, quantity: item.qty }));
  // field.value = JSON.stringify(convertedCart);
  // dateField.value = selectedDate || '';

 
  const field = document.getElementById('orderDataField');
  const dateField = document.getElementById('selectedDateField');

  const convertedCart = cart.map(item => ({ name: item.name, quantity: item.qty }));

  if (convertedCart.length === 0) {
    alert("Please add items to your cart.");
    return false;
  }

  if (!selectedDate) {
    alert("Please select a reservation date.");
    return false;
  }

  field.value = JSON.stringify(convertedCart);
  dateField.value = selectedDate;

  console.log("Sending to checkout:", {
    cart: field.value,
    date: dateField.value
  });

  return true;


}

function prepareCheckoutData() {
  const field = document.getElementById('orderDataField');
  const dateField = document.getElementById('selectedDateField');

  const convertedCart = cart.map(item => ({ name: item.name, quantity: item.qty }));

  if (convertedCart.length === 0) {
    alert("Please add items to your cart.");
    return false;
  }

  if (!selectedDate) {
    alert("Please select a reservation date.");
    return false;
  }

  field.value = JSON.stringify(convertedCart);
  dateField.value = selectedDate;


console.log("Sending to checkout:", {
    cart: field.value,
    date: dateField.value
  });


  return true;
}












//CALENDAR SHIT
 const calendar = document.getElementById("calendar");
const monthText = document.getElementById("calendar-month");
const yearText = document.getElementById("calendar-year");

const prevBtn = document.getElementById("prevMonth");
const nextBtn = document.getElementById("nextMonth");

const monthNames = [
  "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();


function renderCalendar(orderDates) {
  calendar.innerHTML = "";

  monthText.textContent = monthNames[currentMonth];
  yearText.textContent = currentYear;

  const firstDay = new Date(currentYear, currentMonth, 1).getDay();
  const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
  const today = new Date();

  for (let i = 0; i < firstDay; i++) {
    const empty = document.createElement("div");
    empty.className = "calendar-day";
    calendar.appendChild(empty);
  }

  for (let day = 1; day <= daysInMonth; day++) {
  const dayDiv = document.createElement("div");
  dayDiv.className = "calendar-day";
  dayDiv.textContent = day;

  const fullDate = `${currentYear}-${String(currentMonth + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;

  const isPending = orderDates.some(
    order => order.date === fullDate && order.status === "pending"
  );

  if (isPending) {
    dayDiv.classList.add("has-order");
  }

  if (
    day === today.getDate() &&
    currentMonth === today.getMonth() &&
    currentYear === today.getFullYear()
  ) {
    dayDiv.classList.add("today");
  }

  dayDiv.onclick = function () {
    document.querySelectorAll(".calendar-day").forEach(d => d.classList.remove("highlight"));
    dayDiv.classList.add("highlight");
    selectedDate = fullDate;
    console.log("Selected full date:", selectedDate);
  };

  calendar.appendChild(dayDiv);
}
}

function loadAndRenderCalendar() {
  fetch("order_dates.php")
    .then(res => res.json())
    .then(orderDates => {
      renderCalendar(orderDates);
      existingOrderDates = orderDates
        .filter(order => order.status === "pending")
        .map(order => order.date);
    })
    .catch(err => {
      calendar.textContent = "Calendar failed to load.";
      console.error(err);
    });
}

prevBtn.addEventListener("click", () => {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  loadAndRenderCalendar();
});

nextBtn.addEventListener("click", () => {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  loadAndRenderCalendar();
});

loadAndRenderCalendar();

renderDishes();




// JS CHECKOUT MODAL CONFIRMATION LETTER


</script>

</body>
</html>


