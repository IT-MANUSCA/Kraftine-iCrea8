<?php
    include "includes/config.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cat_id = $_POST['cat_id'];
        $category_title = $_POST['category_title'];
        $category_quantity = $_POST['category_quantity'];
        $category_img = $_FILES['category_img']['name'];

        // If a new image is uploaded
        if ($category_img) {
            move_uploaded_file($_FILES['category_img']['tmp_name'], "./images/icons/" . $category_img);
            // Update category with new image
            $sql = "UPDATE category_bar SET category_title = '$category_title', category_quantity = '$category_quantity', category_img = '$category_img' WHERE id = $cat_id";
        } else {
            // Update category without changing image
            $sql = "UPDATE category_bar SET category_title = '$category_title', category_quantity = '$category_quantity' WHERE id = $cat_id";
        }

        if (mysqli_query($conn, $sql)) {
            header("Location: category-bar.php"); // Redirect to the category list page
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
?>
