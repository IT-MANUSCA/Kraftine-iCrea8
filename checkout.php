<?php

include_once 'includes/config.php';
include_once('./includes/headerNav.php');
$customer_id = $_SESSION['id'] ?? null;

if (!$customer_id) {
  header("Location: login.php");
  exit();
}

// Get product IDs from URL
$product_ids = $_GET['product_ids'] ?? [];

if (empty($product_ids)) {
  echo "<script>alert('No items selected.'); window.location.href = 'cart.php';</script>";
  exit();
}

// Get customer info
$customer_name = $customer_email = $customer_phone = '';
$stmt = $conn->prepare("SELECT customer_fname, customer_email, customer_phone FROM customer WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$stmt->bind_result($customer_name, $customer_email, $customer_phone);
$stmt->fetch();
$stmt->close();
?>



<?php
require_once './includes/topheadactions.php';
require_once './includes/desktopnav.php';
require_once './includes/mobilenav.php';
?>
<style>

/* Adapted to match the navbar (#FDFD96) and footer (#36454F) color theme */

body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #fdfdfd;
  color: #333;
}

.checkout-box {
  max-width: 700px;
  margin: 50px auto;
  padding: 30px;
  background-color: #ffffff;
  border: 2px solid #4d3e29;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(54, 69, 79, 0.2);
}

.checkout-box h2 {
  text-align: center;
  color: #4d3e29;
  margin-bottom: 25px;
  font-size: 28px;
}

.checkout-box form label {
  display: block;
  margin-top: 15px;
  font-weight: bold;
  color: #4d3e29;
}

.checkout-box input[type="text"],
.checkout-box input[type="email"] {
  width: 100%;
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 16px;
}

.address-fields {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 10px;
}

.address-fields input {
  flex: 1 1 48%;
}

.single-address-field {
  flex: 1 1 100%;
}

.field-description {
  margin-top: 20px;
  font-size: 14px;
  color: #888;
  text-align: center;
}

.submit-btn-wrapper {
  margin-top: 30px;
  text-align: center;
}

.submit-btn-wrapper button {
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

.submit-btn-wrapper button:hover {
  background-color: #f7f4ef;
  color: #f7f4ef;
}

</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
 
</head>
<body>

  <div class="checkout-box">
    <h2>Shipping Information</h2>
    <form action="checkout-confirm.php" method="POST">
      <!-- Pass selected product IDs as hidden inputs -->
      <?php foreach ($product_ids as $id): ?>
        <input type="hidden" name="product_ids[]" value="<?php echo htmlspecialchars($id); ?>">
      <?php endforeach; ?>

      <label>Full Name</label>
      <input type="text" name="fullname" value="<?php echo htmlspecialchars($customer_name); ?>" readonly>

      <label>Contact Number</label>
      <input type="text" name="contact" value="<?php echo htmlspecialchars($customer_phone); ?>" readonly>

      <label>Email</label>
      <input type="email" name="email" value="<?php echo htmlspecialchars($customer_email); ?>" readonly>

      <label>Address</label>
      <div class="address-fields">
        <input type="text" name="province" placeholder="Province" required>
        <input type="text" name="city" placeholder="City" required>
        <input type="text" name="street" placeholder="Street Name" required>
        <input type="text" name="barangay" placeholder="Barangay" required>
        <input type="text" name="zip" placeholder="Zip Code" required class="single-address-field">
      </div>

      <div class="field-description">
        Please make sure all information is correct before submitting.
      </div>

      <div class="submit-btn-wrapper">
        <button type="submit">Check Information</button>
      </div>
    </form>
  </div>

</body>
</html>

<?php require_once './includes/footer.php'; ?>