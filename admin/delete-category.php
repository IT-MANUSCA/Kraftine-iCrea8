<?php
include "includes/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Optional: delete products under this category first
    // $conn->query("DELETE FROM products WHERE product_catag = (SELECT name FROM category WHERE id = $id)");

    $sql = "DELETE FROM category WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: category.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting category: " . $conn->error;
    }
}

$conn->close();
?>
