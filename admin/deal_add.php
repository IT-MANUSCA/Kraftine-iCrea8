<?php
include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include_once('./includes/config.php');

if (isset($_POST['submit'])) {
  $title = $_POST['deal_title'];
  $desc = $_POST['deal_description'];
  $net = $_POST['deal_net_price'];
  $disc = $_POST['deal_discounted_price'];
  $avail = $_POST['available_deal'];
  $sold = $_POST['sold_deal'];
  $status = isset($_POST['deal_status']) ? 1 : 0;
  $end_date = date('Y-m-d H:i:s', strtotime($_POST['deal_end_date']));

  $image = $_FILES['deal_image']['name'];
  $tmp = $_FILES['deal_image']['tmp_name'];
  $folder = "upload/" . $image;

  if (!move_uploaded_file($tmp, $folder)) {
    die("Image upload failed.");
  }

  $query = "INSERT INTO deal_of_the_day 
    (deal_title, deal_description, deal_net_price, deal_discounted_price, available_deal, sold_deal, deal_image, deal_end_date)
    VALUES 
    ('$title', '$desc', '$net', '$disc', '$avail', '$sold', '$image', '$end_date')";

  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
  }

  header("Location: deal_manage.php");
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
  </style>
</head>

<div class="content-box">
  <div class="update">
    <h1>Add New Deal</h1>
    <form class="row g-3" method="POST" enctype="multipart/form-data">
      <div class="col-md-6">
        <label class="form-label">Title</label>
        <input type="text" name="deal_title" class="form-control" placeholder="Enter Title" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Description</label>
        <textarea name="deal_description" class="form-control" placeholder="Enter Description" required></textarea>
      </div>
      <div class="col-md-6">
        <label class="form-label">Net Price</label>
        <input type="number" step="0.01" name="deal_net_price" class="form-control" placeholder="Enter Net Price" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Discounted Price</label>
        <input type="number" step="0.01" name="deal_discounted_price" class="form-control" placeholder="Enter Discounted Price" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Available Deals</label>
        <input type="number" name="available_deal" class="form-control" placeholder="Available Quantity" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Sold Deals</label>
        <input type="number" name="sold_deal" class="form-control" placeholder="Sold Quantity" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">End Date</label>
        <input type="datetime-local" name="deal_end_date" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Deal Image</label>
        <input type="file" name="deal_image" class="form-control" accept="image/*" required>
      </div>
      <div class="col-12">
        <button type="submit" name="submit" class="btn btn-primary w-100">Add Deal</button>
      </div>
    </form>
  </div>
</div>
