<?php
include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include_once('./includes/config.php');

$banner_id = $_GET['id'];
$query = "SELECT * FROM banner WHERE banner_id = $banner_id";
$result = mysqli_query($conn, $query);
$banner = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subtitle = $_POST['subtitle'];
    $title = $_POST['title'];
    $banner_title_color = $_POST['banner_title_color'];
    $banner_subtitle_color = $_POST['banner_subtitle_color'];
   

    if ($_FILES['image']['name']) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $target_dir = "../images/carousel/";
        move_uploaded_file($image_tmp, $target_dir . $image_name);
    } else {
        $image_name = $banner['banner_image'];
    }

    $update_query = "UPDATE banner SET 
    banner_subtitle = '$subtitle', 
    banner_title = '$title', 
    banner_image = '$image_name',
    banner_title_color = '$banner_title_color',
    banner_subtitle_color = '$banner_subtitle_color',
    WHERE banner_id = $banner_id";


    mysqli_query($conn, $update_query);
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
      height: 100%;
      margin-top: 30px;
    }

    .update {
      border: 1px solid black;
      width: 70%;
      padding: 30px;
      border-radius: 16px;
      background-color: #f1f1f1;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }
  </style>
</head>

<div class="content-box">
  <div class="update">
    <h2>Edit Banner</h2>
    <form class="row g-3" method="post" enctype="multipart/form-data">
      <div class="col-md-6">
        <label class="form-label">Subtitle</label>
        <input type="text" name="subtitle" class="form-control" value="<?php echo $banner['banner_subtitle']; ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Title</label>
        <textarea name="title" class="form-control" required><?php echo $banner['banner_title']; ?></textarea>
      </div>

      <div class="col-md-6">
        <label class="form-label">Title Text Color:</label>
        <input type="color" name="banner_title_color" class="form-control" value="<?php echo $banner['banner_title_color'] ?? '#000000'; ?>">
      </div>

      <div class="col-md-6">
        <label class="form-label">Subtitle Text Color:</label>
        <input type="color" name="banner_subtitle_color" class="form-control" value="<?php echo $banner['banner_subtitle_color'] ?? '#000000'; ?>">
      </div>

      <div class="col-md-6">
        <label class="form-label">Current Image</label><br>
        <img src="../images/carousel/<?php echo $banner['banner_image']; ?>" width="100" class="mb-2"><br>
        <input type="file" name="image" class="form-control">
      </div>

      <div class="col-12">
        <input type="submit" value="Update Banner" class="btn btn-success w-100">
      </div>
    </form>
  </div>
</div>
