<?php
include "includes/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM category_bar WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: category-bar.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting category: " . $conn->error;
    }
}

$conn->close();
?>
