<?php
$orderItems = isset($_POST['orderData']) ? json_decode($_POST['orderData'], true) : [];

if (!$orderItems || count($orderItems) === 0) {
    echo "<p>No items in cart. <a href='menu.php'>Go back to menu</a></p>";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderData']) && isset($_POST['selectedDate'])) {
    $orderDataJson = $_POST['orderData'];
    $selectedDate = $_POST['selectedDate'];
    $cartItems = json_decode($orderDataJson, true);
} else {
    echo "<h2>Error: This page must be accessed after submitting the cart.</h2>";
    exit;
}



?>

<!DOCTYPE html>
<html>
<head>
  <title>Checkout</title>
 <link rel="stylesheet" href="reserve date.css">

  <style>
    /* body { font-family: Arial; margin: 2rem; }
    h2 { margin-bottom: 0.5rem; }
    ul { list-style: none; padding: 0; }
    li { margin: 4px 0; }
    label { display: block; margin-top: 1rem; }
    textarea, input[type=text] { width: 100%; padding: 8px; margin-top: 4px; }
    button { margin-top: 1rem; padding: 10px 20px; } */

    /* body { font-family: Arial; padding: 20px; }
    .summary { margin-bottom: 20px; }
    .summary ul { list-style: none; padding: 0; }
    .summary li { margin-bottom: 5px; }
    .form-section { max-width: 400px; }
    label { display: block; margin-top: 10px; }
    input, textarea { width: 100%; padding: 8px; margin-top: 4px; }
    button { margin-top: 15px; padding: 10px 20px; } */
  </style>
</head>
<body>

  <div class="summaryOrder">
    <h3><hr><b>ORDER SUMMARY</b><hr></h3>
    <p><strong>Selected Dishes:</strong></p>
    <ul>
      <?php foreach ($cartItems as $item): ?>
        <li><h2><?= htmlspecialchars($item['name']) ?> x<?= $item['quantity'] ?></li>
      <?php endforeach; ?>
    </ul>
    <p><strong>Selected Date:</strong> <?= htmlspecialchars($selectedDate) ?></p>
  </div>

  
  
  
  
  
<div class="forms" style="margin-bottom: 3vw;">
      

      <div id="form">
        <form id="contactForm" name="form" action="place_orderREAL.php" method="POST">
        <!-- <input type="hidden" name="orderData" value='<?php echo json_encode($orderItems); ?>' /> -->

         <!-- <input type="hidden" name="orderData" value='<?= json_encode($cartItems) ?>'>
         <input type="hidden" name="selectedDate" value='<?= htmlspecialchars($selectedDate) ?>'> -->

         <input type="hidden" name="orderData" id="orderDataField">
<input type="hidden" name="selectedDate" id="selectedDateField">

          
          <label for="address">Full Address:</label>
          <input type="text" id="address" name="address"><br><br>

          <label for="contact">Contact Number:</label>
          <input type="text" id="contact" name="contact"><br><br>

          <label for="userName">Name:</label>
          <input type="text" id="name" name="name"><br><br>

          <button id="btn" type="submit">CONFIRM</button>

          <p id="responseMessage"></p>
        </form>
      </div>

    
    </div>



</body>
</html>



<script>
document.querySelector("form").addEventListener("submit", function(e) {
  const orderData = <?= json_encode($cartItems) ?>;
  const selectedDate = <?= json_encode($selectedDate) ?>;

  document.getElementById('orderDataField').value = JSON.stringify(orderData);
  document.getElementById('selectedDateField').value = selectedDate;
});
</script>

