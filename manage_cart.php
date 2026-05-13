<?php
session_start();
include_once 'includes/config.php';

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $customer_id = $_SESSION['id'] ?? null; // Check if user is logged in

    $cart_item = array(
        'name' => $_POST['product_name'],
        'price' => $_POST['product_price'],
        'product_id' => $product_id,
        'category' => $_POST['product_category'],
        'product_qty' => $_POST['product_qty'],
        'product_img' => $_POST['product_img']
    );

    // SESSION CART LOGIC (for guest or display)
    if (isset($_SESSION['mycart'])) {
        $item_id = array_column($_SESSION['mycart'], 'product_id');
        if (in_array($product_id, $item_id)) {
            header('Location: viewdetail.php?id=' . $product_id . '&category=' . $_POST['product_category']);
            exit;
        } else {
            $_SESSION['mycart'][] = $cart_item;
        }
    } else {
        $_SESSION['mycart'][0] = $cart_item;
    }

    // Save to DB if user is logged in
    if ($customer_id) {
        $sql_check = "SELECT * FROM cart WHERE customer_id = ? AND product_id = ?";
        $stmt = $conn->prepare($sql_check);
        $stmt->bind_param("ii", $customer_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $sql_insert = "INSERT INTO cart (customer_id, product_id, product_name, product_price, product_img, product_qty)
                           VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("iisdsi",
                $customer_id,
                $product_id,
                $cart_item['name'],
                $cart_item['price'],
                $cart_item['product_img'],
                $cart_item['product_qty']
            );
            $stmt_insert->execute();
        }
    }

    header('Location: viewdetail.php?id=' . $product_id . '&category=' . $_POST['product_category']);
    exit;
}
?>
