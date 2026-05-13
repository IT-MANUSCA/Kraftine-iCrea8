<?php
session_start();
include_once 'includes/config.php';

header('Content-Type: application/json');

$customer_id = $_SESSION['id'] ?? null;
$product_id = $_POST['product_id'] ?? null;
$action = $_POST['action'] ?? null;

if (!$customer_id || !$product_id || !$action) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

if ($action === 'increase') {
    $sql = "UPDATE cart SET product_qty = product_qty + 1 WHERE customer_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $customer_id, $product_id);
    $stmt->execute();
} elseif ($action === 'decrease') {
    $sql = "UPDATE cart SET product_qty = CASE WHEN product_qty > 1 THEN product_qty - 1 ELSE 1 END WHERE customer_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $customer_id, $product_id);
    $stmt->execute();
} elseif ($action === 'remove') {
    $sql = "DELETE FROM cart WHERE customer_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $customer_id, $product_id);
    $stmt->execute();
    echo json_encode(['success' => true]);
    exit;
}

// Return new quantity
$sql = "SELECT product_qty FROM cart WHERE customer_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $customer_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo json_encode(['success' => true, 'new_qty' => $row['product_qty'] ?? 1]);
