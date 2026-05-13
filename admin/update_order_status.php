<?php
include_once('./includes/config.php'); // database connection
include_once('./includes/restriction.php'); // optional admin-only access

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Simple security: sanitize inputs
    $order_id = mysqli_real_escape_string($conn, $order_id);
    $status = mysqli_real_escape_string($conn, $status);

    $update_query = "UPDATE orders SET status = '$status' WHERE order_id = $order_id";

    if (mysqli_query($conn, $update_query)) {
        $_SESSION['success'] = "Order status updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update order status.";
    }

    // Redirect back to order management page
    header("Location: order_manage.php");
    exit();
} else {
    // Direct access is not allowed
    header("Location: order_manage.php");
    exit();
}
