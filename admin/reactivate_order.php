<?php
include_once('./includes/config.php');

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    // Update the order's archived status to 0 (unarchive)
    $query = "UPDATE orders SET archived = 0 WHERE order_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $order_id);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: view_archived_orders.php'); // Redirect back to the archived orders page
    } else {
        echo "Error reactivating order.";
    }
}
?>
