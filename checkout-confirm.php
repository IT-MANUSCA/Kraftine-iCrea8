<?php

include_once 'includes/config.php';
include_once('./includes/headerNav.php');
$customer_id = $_SESSION['id'] ?? null;

if (!$customer_id) {
  echo "<script>alert('Session expired. Please log in again.'); window.location.href='login.php';</script>";
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fullname = $_POST['fullname'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $province = $_POST['province'];
  $city = $_POST['city'];
  $street = $_POST['street'];
  $barangay = $_POST['barangay'];
  $zip = $_POST['zip'];
  $product_ids = $_POST['product_ids'] ?? [];

  if (empty($product_ids)) {
    echo "<script>alert('No products selected.'); window.location.href = 'cart.php';</script>";
    exit();
  }

  // Fetch selected cart items
  $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
  $types = str_repeat('i', count($product_ids) + 1);
  $params = array_merge([$customer_id], $product_ids);

  $stmt = $conn->prepare("SELECT * FROM cart WHERE customer_id = ? AND product_id IN ($placeholders)");
  $stmt->bind_param($types, ...$params);
  $stmt->execute();
  $result = $stmt->get_result();

  $cart_items = [];
  $total = 0;
  while ($row = $result->fetch_assoc()) {
    $subtotal = $row['product_price'] * $row['product_qty'];
    $total += $subtotal;
    $cart_items[] = [
      'name' => $row['product_name'],
      'price' => $row['product_price'],
      'qty' => $row['product_qty'],
      'subtotal' => $subtotal,
      'img' => $row['product_img'] // Add this line
    ];
    
  }

  // Add shipping fee
  $shipping_fee = 50.00; // Standard shipping fee
  $total_with_shipping = $total + $shipping_fee;

  // Save to `orders` table
  $order_sql = "INSERT INTO orders (customer_id, fullname, contact, email, province, city, street, barangay, zip, total_amount, shipping_fee) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($order_sql);
  $stmt->bind_param("issssssssdd", $customer_id, $fullname, $contact, $email, $province, $city, $street, $barangay, $zip, $total_with_shipping, $shipping_fee);
  $stmt->execute();
  $order_id = $stmt->insert_id;

  // Save each item into `order_items` table
  $item_stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, product_price, product_qty, subtotal, product_img) VALUES (?, ?, ?, ?, ?, ?)");


  foreach ($cart_items as $item) {
    $item_stmt->bind_param("isdids", $order_id, $item['name'], $item['price'], $item['qty'], $item['subtotal'], $item['img']);

    $item_stmt->execute();
  }

  // Remove items from the cart that were ordered
  $delete_stmt = $conn->prepare("DELETE FROM cart WHERE customer_id = ? AND product_id IN ($placeholders)");
  $delete_stmt->bind_param($types, ...$params);
  $delete_stmt->execute();
  
} else {
  echo "<script>alert('Invalid access.'); window.location.href = 'cart.php';</script>";
  exit();
}
?>



<?php
require_once './includes/topheadactions.php';
require_once './includes/desktopnav.php';
require_once './includes/mobilenav.php';
?>

<style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #fdfdfd;
      color: #333;
    }

    .confirmation-box {
      max-width: 800px;
      margin: 50px auto;
      padding: 30px;
      background-color: #ffffff;
      border: 2px solid #4d3e29;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(77, 62, 41, 0.2);
    }

    .confirmation-box h2 {
      text-align: center;
      color: #4d3e29;
      font-size: 30px;
      margin-bottom: 30px;
    }

    .info-group {
      margin-bottom: 30px;
      background-color: #f7f4ef;
      padding: 20px;
      border-radius: 10px;
    }

    .info-group div {
      margin-bottom: 10px;
      font-size: 16px;
    }

    .info-group label {
      font-weight: bold;
      color: #4d3e29;
      margin-right: 5px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      background-color: #fff;
      border: 1px solid #ccc;
    }

    table th,
    table td {
      padding: 12px 10px;
      text-align: center;
      border-bottom: 1px solid #ccc;
    }

    table th {
      background-color: #4d3e29;
      color: #f7f4ef;
    }

    table tr:nth-child(even) {
      background-color: #f7f4ef;
    }

    .total-box {
      margin-top: 20px;
      font-size: 18px;
      font-weight: bold;
      color: #4d3e29;
      text-align: right;
    }

    .note {
      margin-top: 30px;
      font-size: 14px;
      background-color: #fff8dc;
      padding: 15px;
      border-left: 5px solid #4d3e29;
      border-radius: 6px;
    }

    .btn-box {
      margin-top: 30px;
      text-align: center;
    }

    .btn-box button {
      background-color: #4d3e29;
      color: #f7f4ef;
      padding: 12px 30px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-box button:hover {
      background-color: #f7f4ef;
      color: #4d3e29;
      border: 1px solid #4d3e29;
    }
  </style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirmation</title>
  
</head>
<body>

<div class="confirmation-box">
  <h2>Order Confirmation</h2>

  <div class="info-group">
    <div><label>Full Name:</label> <span><?php echo htmlspecialchars($fullname); ?></span></div>
    <div><label>Contact Number:</label> <span><?php echo htmlspecialchars($contact); ?></span></div>
    <div><label>Email Address:</label> <span><?php echo htmlspecialchars($email); ?></span></div>
    <div><label>Shipping Address:</label> <span><?php echo htmlspecialchars("$street, $barangay, $city, $province, $zip"); ?></span></div>
  </div>

  <h3 style="text-align:center; color:#36454F;">Your Order Summary</h3>

  <table>
    <thead>
      <tr>
        <th>Item Name</th>
        <th>Unit Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cart_items as $item): ?>
        <tr>
          <td><?php echo htmlspecialchars($item['name']); ?></td>
          <td>₱<?php echo number_format($item['price'], 2); ?></td>
          <td><?php echo $item['qty']; ?></td>
          <td>₱<?php echo number_format($item['subtotal'], 2); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="total-box">
  <span>Total Amount (Standard Fee: ₱50): </span>₱<?php echo number_format($total_with_shipping, 2); ?>
</div>

  <div class="note">
    <p><strong>Note:</strong> Please review your order details carefully before confirming. You will receive a confirmation email shortly after your order is placed.</p>
  </div>

  <div class="btn-box">
    <button onclick="window.location.href='thankyou.php'">PLACE ORDER</button>
  </div>
</div>

</body>
</html>
<?php require_once './includes/footer.php'; ?>