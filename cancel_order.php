<?php
include_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $order_id = $_POST['order_id'] ?? null;

  if ($order_id) {
    $cancel_status = 'Cancelled';

    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
    $stmt->bind_param('si', $cancel_status, $order_id);

    if ($stmt->execute()) {
      echo 'success';
    } else {
      echo 'error';
    }
  } else {
    echo 'invalid';
  }
}
?>
