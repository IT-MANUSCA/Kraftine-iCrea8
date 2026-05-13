<?php
include_once('includes/headerNav.php');
include_once 'includes/config.php';

$customer_id = $_SESSION['id'] ?? null;

if (!$customer_id) {
  echo "<script>alert('Session expired. Please log in again.'); window.location.href='login.php';</script>";
  exit();
}

$ongoing_orders = [];
$completed_orders = [];
$cancelled_orders = [];

$sql = "SELECT * FROM orders WHERE customer_id = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $customer_id);
$stmt->execute();
$result = $stmt->get_result();

while ($order = $result->fetch_assoc()) {
    switch ($order['status']) {
        case 'Pending':
        case 'On the Way':
            $ongoing_orders[] = $order;
            break;
        case 'Delivered':
            $completed_orders[] = $order;
            break;
        case 'Cancelled':
            $cancelled_orders[] = $order;
            break;
    }
}
?>

<!-- Modal HTML -->
<div id="purchasesModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>

    <div class="container">
      <div class="tabs">
        <button class="tab-button active" data-tab="ongoing">Ongoing Orders</button>
        <button class="tab-button" data-tab="completed">Completed Orders</button>
        <button class="tab-button" data-tab="cancelled">Cancelled Orders</button>
      </div>

      <div id="ongoing" class="order-section active">
        <h2>Ongoing Orders</h2>
        <?php if (count($ongoing_orders) > 0): ?>
        <table>
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Order Date</th>
              <th>Status</th>
              <th>Total Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($ongoing_orders as $order): ?>
            <tr>
              <td><?= $order['order_id'] ?></td>
              <td><?= $order['order_date'] ?></td>
              <td><?= $order['status'] ?></td>
              <td>₱<?= number_format($order['total_amount'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?>
        <p>No ongoing orders found.</p>
        <?php endif; ?>
      </div>

      <div id="completed" class="order-section">
        <h2>Completed Orders</h2>
        <?php if (count($completed_orders) > 0): ?>
        <table>
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Order Date</th>
              <th>Status</th>
              <th>Total Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($completed_orders as $order): ?>
            <tr>
              <td><?= $order['order_id'] ?></td>
              <td><?= $order['order_date'] ?></td>
              <td><?= $order['status'] ?></td>
              <td>₱<?= number_format($order['total_amount'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?>
        <p>No completed orders found.</p>
        <?php endif; ?>
      </div>

      <div id="cancelled" class="order-section">
        <h2>Cancelled Orders</h2>
        <?php if (count($cancelled_orders) > 0): ?>
        <table>
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Order Date</th>
              <th>Status</th>
              <th>Total Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cancelled_orders as $order): ?>
            <tr>
              <td><?= $order['order_id'] ?></td>
              <td><?= $order['order_date'] ?></td>
              <td><?= $order['status'] ?></td>
              <td>₱<?= number_format($order['total_amount'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?>
        <p>No cancelled orders found.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<style>
  /* Modal styles */
  .modal {
    display: none;
    position: fixed;
    z-index: 1001;
    left: 0; top: 0;
    width: 100%; height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.6);
  }

  .modal-content {
    background-color: #fff;
    margin: 60px auto;
    padding: 20px;
    border-radius: 10px;
    width: 90%;
    max-width: 1100px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    position: relative;
  }

  .close {
    color: #aaa;
    position: absolute;
    top: 15px;
    right: 25px;
    font-size: 30px;
    font-weight: bold;
    cursor: pointer;
  }

  .close:hover {
    color: #000;
  }

  .container {
    padding: 20px;
  }

  /* Existing styles can remain below */
  /* (keep the existing .tabs, .tab-button, table etc.) */
</style>

<script>
  // Modal open/close logic
  const modal = document.getElementById("purchasesModal");
  const openBtn = document.getElementById("openPurchasesBtn");
  const closeBtn = document.querySelector(".close");

  openBtn.onclick = () => modal.style.display = "block";
  closeBtn.onclick = () => modal.style.display = "none";
  window.onclick = (e) => { if (e.target == modal) modal.style.display = "none"; };

  // Tab switching logic
  const tabButtons = document.querySelectorAll('.tab-button');
  const orderSections = document.querySelectorAll('.order-section');

  tabButtons.forEach(button => {
    button.addEventListener('click', () => {
      tabButtons.forEach(btn => btn.classList.remove('active'));
      orderSections.forEach(section => section.classList.remove('active'));

      button.classList.add('active');
      const tabId = button.getAttribute('data-tab');
      document.getElementById(tabId).classList.add('active');
    });
  });
</script>
