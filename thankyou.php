<!DOCTYPE html>
<html lang="en">

<?php
include_once 'includes/config.php';
include_once('./includes/headerNav.php');

?>


<?php
require_once './includes/topheadactions.php';
require_once './includes/desktopnav.php';
require_once './includes/mobilenav.php';
?>


<style>
    body {
      margin: 0;
      padding: 0;
      background-color: #fdfdfd;
      font-family: 'Arial', sans-serif;
      color: #333;
    }

    .box {
      max-width: 600px;
      margin: 80px auto;
      padding: 40px;
      background-color: #ffffff;
      border: 2px solid #4d3e29;
      border-radius: 14px;
      box-shadow: 0 6px 15px rgba(54, 69, 79, 0.25);
      text-align: center;
    }

    .box h1 {
      font-size: 32px;
      color: #4d3e29;
      margin-bottom: 20px;
    }

    .box p {
      font-size: 16px;
      color: #555;
      margin-bottom: 30px;
    }

    .btn {
      display: inline-block;
      background-color: #4d3e29;
      color: #fdfdfd;
      padding: 12px 28px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn:hover {
      background-color: #fdfdfd;
      color: #4d3e29;
      border: 1px solid #4d3e29;
    }

    .note {
      margin-top: 30px;
      font-size: 14px;
      color: #888;
    }
  </style>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Placed</title>
  
</head>
<body>

  <div class="box">
    <h1>Thank You for Your Order!</h1>
    <p>Your order has been placed successfully. You will receive an email with your order details shortly.</p>
    <a href="index.php" class="btn">Back to Home</a>

    <div class="note">
      <p>If you have any questions or need assistance, feel free to contact us.</p>
    </div>
  </div>

</body>
</html>


<?php require_once './includes/footer.php'; ?>