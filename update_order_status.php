<?php
include_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $order_id = $_POST['order_id'] ?? null;
  $status = $_POST['status'] ?? null;

  if ($order_id && $status) {
    // Update the order status to 'Completed'
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
    $stmt->bind_param("si", $status, $order_id);
    if ($stmt->execute()) {
      echo "Order status updated successfully!";
    } else {
      echo "Error updating status.";
    }
  }
}
?>
