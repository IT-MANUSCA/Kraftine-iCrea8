<?php
include_once('includes/headerNav.php');
include_once 'includes/config.php';

$customer_id = $_SESSION['id'] ?? null;

if (!$customer_id) {
  echo "<script>alert('Session expired. Please log in again.'); window.location.href='login.php';</script>";
  exit();
}

$cancelled = [];

$stmt = $conn->prepare("SELECT * FROM orders WHERE customer_id = ? ORDER BY order_date DESC");
$stmt->bind_param('i', $customer_id);
$stmt->execute();
$result = $stmt->get_result();

while ($order = $result->fetch_assoc()) {
  if ($order['status'] === 'Cancelled') {
    $cancelled[] = $order;
  }
}

function renderCancelledOrders($orders) {
  global $conn;
  if (count($orders) === 0) return "<p style='text-align:center; font-size: 1.2rem; color: #555;'>No cancelled orders.</p>";

  $output = "";
  foreach ($orders as $order) {
    $order_id = $order['order_id'];
    $full_address = "{$order['street']}, {$order['barangay']}, {$order['city']}, {$order['province']} {$order['zip']}";

    $output .= "<div class='order-card'>
      <div class='order-header'>
        <h3>Recipient: {$order['fullname']}</h3>
        <div class='order-info'>
          <p><strong>Address:</strong> {$full_address}</p>
          <p><strong>Contact:</strong> {$order['contact']}</p>
        </div>
      </div>
      <table class='order-items'>
        <tr><th>Image</th><th>Product Name</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";

    $stmt_items = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt_items->bind_param("i", $order_id);
    $stmt_items->execute();
    $result_items = $stmt_items->get_result();

    while ($item = $result_items->fetch_assoc()) {
      $product_img = $item['product_img'] ?? 'default.jpg';
      $output .= "<tr>
        <td><img src='product_images/{$product_img}' width='70' height='70' alt='Product Image'></td>
        <td>{$item['product_name']}</td>
        <td>₱{$item['product_price']}</td>
        <td>{$item['product_qty']}</td>
        <td>₱{$item['subtotal']}</td>
      </tr>";
    }

    $output .= "</table>
      <div class='order-footer'>
        <div class='status-section'>
          <p><strong>Total:</strong> ₱{$order['total_amount']}</p>
          <p><strong>Status:</strong> <span class='status cancelled'>{$order['status']}</span></p>
        </div>
      </div>
    </div>";
  }

  return $output;
}
?>



<?php
require_once './includes/topheadactions.php';
require_once './includes/desktopnav.php';
require_once './includes/mobilenav.php';
?>




<h2>Cancelled Orders</h2>
<div style="max-width: 950px; margin: auto;">
  <?php echo renderCancelledOrders($cancelled); ?>
</div>

<!-- Modal -->
<div id="popupModal">
  <div class="modal-content">
    <h3 id="modalTitle">Modal Title</h3>
    <p id="modalMessage">This is a placeholder message.</p>
    <button class="btn green" onclick="closeModal()">OK</button>
  </div>
</div>

<script>
function openModal(action) {
  const modal = document.getElementById("popupModal");
  const title = document.getElementById("modalTitle");
  const msg = document.getElementById("modalMessage");

  if (action === 'track') {
    title.innerText = "Track Order";
    msg.innerText = "Tracking details will be available soon.";
  }

  modal.style.display = "flex";
}

function closeModal() {
  document.getElementById("popupModal").style.display = "none";
}
</script>



<?php require_once './includes/footer.php'; ?>

<style>
body {
  font-family: 'Arial', sans-serif;
  background-color: #f7f7f7;
  color: #333;
}

/* Header */
h2 {
  font-size: 2rem;
  color: #4d3e29;
  text-align: center;
  margin-top: 100px;
  font-weight: bold;
}

/* Order Cards */
.order-card {
  background-color: #fff;
  border-radius: 10px;
  margin: 20px 0;
  padding: 20px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  margin-bottom: 200px;
}

.order-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.order-header h3 {
  font-size: 1.3rem;
}

.order-info p {
  font-size: 0.9rem;
  color: #555;
}

.order-items {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

.order-items th, .order-items td {
  padding: 12px;
  text-align: left;
}

.order-items th {
  background-color: #4d3e29;
  color: white;
}

.order-items td {
  background-color: #f9f9f9;
}

.order-items td img {
  border-radius: 5px;
}

.order-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 15px;
}

.status-section p {
  font-size: 1rem;
}

.status {
  font-weight: bold;
  padding: 5px 10px;
  border-radius: 5px;
}

.status.Pending {
  background-color: #4d3e29;
  color: #fff;
}

.status['On the Way'] {
  background-color: #4CAF50;
  color: #fff;
}

.action-buttons {
  display: flex;
  gap: 10px;
}

.btn {
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  font-size: 0.9rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn.blue {
  background-color: #4d3e29;
  color: white;
}

.btn.red {
  background-color:rgb(160, 6, 6);
  color: white;
}

.btn.green {
  background-color: #28a745;
  color: white;
}

.btn:hover {
  transform: scale(1.05);
}

.status-info {
  color: gray;
  font-size: 0.9rem;
}

/* Modal Styles */
#popupModal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.6);
  z-index: 999;
  justify-content: center;
  align-items: center;
}

#popupModal .modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  width: 300px;
  text-align: center;
}

#popupModal h3 {
  color: #4d3e29;
}

#popupModal .btn.green {
  background-color: #28a745;
  color: white;
}

#popupModal .btn.green:hover {
  background-color: #218838;
}
</style>
