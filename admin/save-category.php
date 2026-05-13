<?php
include "includes/config.php"; // Your DB connection

if (isset($_POST['submit'])) {
    $category_name = mysqli_real_escape_string($conn, $_POST['category-name']);

    // Handle Image Upload
    $image_name = $_FILES['category-img']['name'];
    $temp_name = $_FILES['category-img']['tmp_name'];
    $upload_dir = "uploads/categories/";

    // Ensure upload folder exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $target_path = $upload_dir . basename($image_name);

    if (move_uploaded_file($temp_name, $target_path)) {
        // Insert into DB
        $sql = "INSERT INTO category (name, img) VALUES ('$category_name', '$image_name')";
        if ($conn->query($sql) === TRUE) {
            header("Location: add_category.php?msg=Category added successfully");
            exit();
        } else {
            echo "Database error: " . $conn->error;
        }
    } else {
        echo "Image upload failed.";
    }

    $conn->close();
} else {
    echo "Invalid form submission.";
}
