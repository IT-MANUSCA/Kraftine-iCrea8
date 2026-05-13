<?php
include "includes/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_title = $_POST['category_title'];
    $category_quantity = $_POST['category_quantity'];
    $category_img = $_FILES['category_img']['name'];
    $tmp_name = $_FILES['category_img']['tmp_name'];

    $target_dir = "../images/icons/";
    $target_file = $target_dir . basename($category_img);

    if (move_uploaded_file($tmp_name, $target_file)) {
        $sql = "INSERT INTO category_bar (category_title, category_quantity, category_img, category_status) 
                VALUES ('$category_title', '$category_quantity', '$category_img', 1)";
        if (mysqli_query($conn, $sql)) {
            header("Location: category-bar.php");
            exit;
        } else {
            echo "Database insert error: " . mysqli_error($conn);
        }
    } else {
        echo "Error uploading image.";
    }
}
?>