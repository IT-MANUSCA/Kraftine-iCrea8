<?php
include_once('./includes/config.php');

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    $query = "UPDATE orders SET archived = 1 WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo "<script>alert('Order archived successfully!'); window.location.href='order_manage.php';</script>";
    } else {
        echo "<script>alert('Error archiving order.'); window.location.href='order_manage.php';</script>";
    }
}
?>
