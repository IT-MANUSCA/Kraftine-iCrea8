<?php
include_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $order_id = $_POST['order_id'] ?? null;

  if ($order_id) {
    $new_status = 'Received';

    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
    $stmt->bind_param('si', $new_status, $order_id);

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
