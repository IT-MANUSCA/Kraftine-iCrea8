<?php
include "includes/config.php";

if(empty($_FILES['logo']['name'])){
  $file_name = $_POST['old_logo'];
}else{
  $errors = array();

  $file_name = $_FILES['logo']['name'];
  $file_size = $_FILES['logo']['size'];
  $file_tmp = $_FILES['logo']['tmp_name']; // Temporary address where the file is located before processing the upload request
  $file_type = $_FILES['logo']['type'];

  // Store the result of explode() in a variable
  $file_ext_array = explode('.', $file_name);
  $file_ext = end($file_ext_array);  // Pass the variable to end()

  $extensions = array("jpeg", "jpg", "png");

  if(in_array($file_ext, $extensions) === false) {
    $errors[] = "This extension file is not allowed. Please choose a JPG or PNG file.";
  }

  if($file_size > 2097152) {
    $errors[] = "File size must be 2MB or lower.";
  }

  if(empty($errors) == true){
    move_uploaded_file($file_tmp, "upload/".$file_name);
  } else {
    print_r($errors);
    die();
  }
}

// Escape the user input to prevent SQL injection and syntax errors
$website_name = mysqli_real_escape_string($conn, $_POST["website_name"]);
$website_footer = mysqli_real_escape_string($conn, $_POST["footer_desc"]);

// Build the SQL query
$sql = "UPDATE settings SET website_name='{$website_name}', website_logo='{$file_name}', website_footer='{$website_footer}'";

// Execute the query
$result = mysqli_query($conn, $sql);

if($result) {
  header("location: settings.php?saved");
} else {
  // Print the specific MySQL error
  echo "Query Failed: " . mysqli_error($conn);
}
?>
