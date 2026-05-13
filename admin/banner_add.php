<?php
include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include_once('./includes/config.php'); // Ensure $conn is defined

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $banner_subtitle_color = $_POST['banner_subtitle_color'];
  $title = $_POST['title'];
  $image_name = $_FILES['image']['name'];
  $image_tmp = $_FILES['image']['tmp_name'];
  $target_dir = "../images/carousel/";
  move_uploaded_file($image_tmp, $target_dir . $image_name);
  $banner_title_color = $_POST['banner_title_color'];
  $subtitle = $_POST['subtitle'];
  

  // Insert into DB
  $query = "INSERT INTO banner (banner_subtitle, banner_title, banner_image, banner_title_color, banner_subtitle_color) 
          VALUES (?, ?, ?, ?, ?)";
          $stmt = $conn->prepare($query);
          $stmt->bind_param("sssss", $subtitle, $title, $image_name, $banner_title_color, $banner_subtitle_color);
          $stmt->execute();

  header("Location: admin_banner.php");
  exit();
}
?>

<head>
  <style>
    .content-box {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin-top: 30px;
    }

    .update {
      width: 70%;
      padding: 30px;
      border-radius: 16px;
      background-color: #f1f1f1;
      border: 1px solid black;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }
  </style>
</head>

<div class="content-box">
  <div class="update">
    <h2>Add New Banner</h2>
    <form action="" method="post" enctype="multipart/form-data" class="row g-3">
      <div class="col-md-6">
        <label for="subtitle" class="form-label">Subtitle</label>
        <input type="text" name="subtitle" class="form-control" required>
      </div>

      <div class="col-md-6">
        <label for="title" class="form-label">Title</label>
        <textarea name="title" class="form-control" required></textarea>
      </div>

      <div class="col-md-6">
        <label for="banner_text_color">Title Text Color:</label>
        <input type="color" id="banner_text_color" name="banner_title_color" value="#000000">
      </div>

      <div class="col-md-6">
        <label for="banner_subtitle_color">Subtitle Text Color:</label>
        <input type="color" id="banner_subtitle_color" name="banner_subtitle_color" value="#000000">
      </div>

      <div class="col-md-6">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" class="form-control" required>
      </div>

      <div class="col-12">
        <input type="submit" value="Add Banner" class="btn btn-success w-100">
      </div>
    </form>
  </div>
</div>
