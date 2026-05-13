<?php
include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include_once('./includes/config.php'); // Ensure DB connection

// Fetch banner ID from URL
$banner_id = $_GET['id'];

// Fetch the banner details for image path
$query = "SELECT banner_image FROM banner WHERE banner_id = $banner_id";
$result = mysqli_query($conn, $query);
$banner = mysqli_fetch_assoc($result);

// Delete the banner from the database
$delete_query = "DELETE FROM banner WHERE banner_id = $banner_id";
if (mysqli_query($conn, $delete_query)) {
    // Remove the image from the server
    $image_path = "../images/carousel/" . $banner['banner_image'];
    if (file_exists($image_path)) {
        unlink($image_path);
    }
    header("Location: admin_banner.php"); // Redirect back to the banner list
    exit();
} else {
    echo "Error: Could not delete banner.";
}
?>

