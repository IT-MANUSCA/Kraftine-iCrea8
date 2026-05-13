<?php
include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include "includes/config.php";

// Fetch the category data based on ID
$cat_id = $_GET['id'];
$sql = "SELECT * FROM category_bar WHERE id = $cat_id";
$result = mysqli_query($conn, $sql);
$category = mysqli_fetch_assoc($result);

if (!$category) {
    echo "Category not found!";
    exit;
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

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }
  </style>
</head>

<div class="content-box">
  <div class="update">
    <h1>Edit Category</h1>
    <form action="update-category-bar.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="cat_id" value="<?php echo $category['id']; ?>">

      <div class="form-group">
        <label for="category_title">Category Title</label>
        <input type="text" name="category_title" class="form-control" id="category_title" value="<?php echo $category['category_title']; ?>" required>
      </div>

      <div class="form-group">
        <label for="category_quantity">Quantity</label>
        <input type="number" name="category_quantity" class="form-control" id="category_quantity" value="<?php echo $category['category_quantity']; ?>" required>
      </div>

      <div class="form-group">
        <label for="category_img">Category Image</label><br>
        <img src="./images/icons/<?php echo $category['category_img']; ?>" alt="category image" width="100"><br><br>
        <input type="file" name="category_img" class="form-control" id="category_img">
      </div>

      <button type="submit" class="btn btn-success w-100">Update Category</button>
    </form>
  </div>
</div>

<?php mysqli_close($conn); ?>
