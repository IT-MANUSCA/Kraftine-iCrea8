<?php
include_once('includes/headerNav.php');
include_once 'includes/config.php';

$customer_id = $_SESSION['id'] ?? null;

if (!$customer_id) {
  echo "<script>alert('Session expired. Please log in again.'); window.location.href='login.php';</script>";
  exit();
}

$ongoing = $completed = $cancelled = [];

$stmt = $conn->prepare("SELECT * FROM orders WHERE customer_id = ? ORDER BY order_date DESC");
$stmt->bind_param('i', $customer_id);
$stmt->execute();
$result = $stmt->get_result();

while ($order = $result->fetch_assoc()) {
  switch ($order['status']) {
    case 'Pending':
    case 'On the Way':
      $ongoing[] = $order;
      break;
    case 'Delivered':
    case 'Received':
      $completed[] = $order;
      break;
    case 'Cancelled':
      $cancelled[] = $order;
      break;
  }
}

function renderTable($orders) {
  global $conn;
  if (count($orders) === 0) {
    return "<p style='text-align:center;'>No orders found.</p>";
  }

  $output = "";

  foreach ($orders as $order) {
    $order_id = $order['order_id'];
    $full_address = "{$order['street']}, {$order['barangay']}, {$order['city']}, {$order['province']} {$order['zip']}";

    $output .= "<div class='order-card'>";
    $output .= "<div class='order-header'>
                  <h3>Recipient: {$order['fullname']}</h3>
                  <div class='order-info'>
                    <p><strong>Address:</strong> {$full_address}</p>
                    <p><strong>Contact:</strong> {$order['contact']}</p>
                  </div>
                </div>";

    $output .= "<table>
                  <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                  </tr>";

    $sql_items = "SELECT * FROM order_items WHERE order_id = ?";
    $stmt_items = $conn->prepare($sql_items);
    $stmt_items->bind_param("i", $order_id);
    $stmt_items->execute();
    $result_items = $stmt_items->get_result();

    while ($item = $result_items->fetch_assoc()) {
      $product_img = $item['product_img'] ?? 'default.jpg';
      $output .= "<tr>
                    <td><img src='product_images/{$product_img}' width='70' height='70'></td>
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
                    <p><strong>Status:</strong> {$order['status']}</p>
                  </div>
                  <div class='action-buttons'>";

    if ($order['status'] == 'Pending') {
      $output .= "<button class='btn blue'>Track Order</button>";
      $output .= "<button class='btn red'>Cancel Order</button>";
    } elseif ($order['status'] == 'On the Way') {
      $output .= "<button class='btn blue'>Track Order</button>";
      $output .= "<p style='color:gray;'>Order cannot be cancelled at this stage.</p>";
    } elseif ($order['status'] == 'Delivered' || $order['status'] == 'Received') {
      $output .= "<button class='btn green'>Mark as Received</button>";
    }

    $output .= "  </div>
                </div>
              </div>";
  }

  return $output;
}
?>

<!-- STYLES -->
<style>
  body {
    background-color: #f4f6f8;
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    padding: 0;
  }

  .nav-links {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin: 30px auto 20px;
    flex-wrap: wrap;
  }

  .nav-links a {
    padding: 10px 25px;
    text-decoration: none;
    border-radius: 30px;
    background-color: #ddd;
    color: #333;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
  }

  .nav-links a.active,
  .nav-links a:hover {
    background-color: #e75480;
    color: #fff;
  }

  .order-tab {
    display: none;
    max-width: 950px;
    margin: 0 auto;
  }

  .order-tab.active {
    display: block;
  }

  .order-card {
    border: 1px solid #ddd;
    padding: 20px;
    margin-bottom: 25px;
    border-radius: 15px;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    position: relative;
  }

  .order-header {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    margin-bottom: 10px;
  }

  .order-info p {
    margin: 4px 0;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    background: #fff;
  }

  th, td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: left;
  }

  th {
    background: #f7f7f7;
  }

  img {
    border-radius: 8px;
    object-fit: cover;
  }

  .order-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    margin-top: 15px;
  }

  .status-section p {
    margin: 5px 0;
    font-weight: 500;
  }

  .action-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }

  .btn {
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .btn.blue { background-color: #007bff; }
  .btn.red { background-color: #dc3545; }
  .btn.green { background-color: #28a745; }
  .btn:hover { filter: brightness(0.9); }
</style>

<!-- NAV LINKS -->
<div class="nav-links">
  <a href="my_purchases_ongoing.php" class="active" onclick="switchTab(event, 'ongoing')">Ongoing</a>
  <a href="javascript:void(0);" onclick="switchTab(event, 'completed')">Completed</a>
  <a href="javascript:void(0);" onclick="switchTab(event, 'cancelled')">Cancelled</a>
</div>

<!-- ORDER CONTENT -->
<div id="ongoing" class="order-tab active"><?php echo renderTable($ongoing); ?></div>
<div id="completed" class="order-tab"><?php echo renderTable($completed); ?></div>
<div id="cancelled" class="order-tab"><?php echo renderTable($cancelled); ?></div>

<!-- SCRIPT -->
<script>
  function switchTab(event, tabId) {
    // Hide all tabs
    const tabs = document.querySelectorAll('.order-tab');
    tabs.forEach(tab => tab.classList.remove('active'));

    // Show selected tab
    const selectedTab = document.getElementById(tabId);
    if (selectedTab) selectedTab.classList.add('active');

    // Update active link
    const links = document.querySelectorAll('.nav-links a');
    links.forEach(link => link.classList.remove('active'));

    event.target.classList.add('active');
  }
</script>
