<?php
include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include "includes/config.php"; // Ensure DB connection
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
    <h2>Add New Category</h2>
    <form class="row g-3" action="" method="POST" enctype="multipart/form-data">
      <div class="col-md-6">
        <label for="category_title" class="form-label">Category Title</label>
        <input type="text" name="category_title" class="form-control" id="category_title" required>
      </div>


      <div class="col-md-12">
        <label for="category_img" class="form-label">Category Image</label>
        <input type="file" name="category_img" class="form-control" id="category_img" required>
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-primary w-100">Add Category</button>
      </div>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category_title = $_POST['category_title'];
        $category_img = $_FILES['category_img']['name'];

        // Upload image
        move_uploaded_file($_FILES['category_img']['tmp_name'], "../images/icons" . $category_img);

        // Insert category into the database
        $sql = "INSERT INTO category_bar (category_title, category_img) 
                VALUES ('$category_title', '$category_img')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success mt-3'>Category added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
    ?>
  </div>
</div>

<?php mysqli_close($conn); ?>
