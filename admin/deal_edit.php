<?php
include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include_once('./includes/config.php');

$id = $_GET['id'];
$query = "SELECT * FROM deal_of_the_day WHERE deal_id = $id";
$result = mysqli_query($conn, $query);
$deal = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
  $title = $_POST['deal_title'];
  $desc = $_POST['deal_description'];
  $net = $_POST['deal_net_price'];
  $disc = $_POST['deal_discounted_price'];
  $avail = $_POST['available_deal'];
  $sold = $_POST['sold_deal'];
  $end_date = $_POST['deal_end_date'];

  $image = $deal['deal_image'];
  if ($_FILES['deal_image']['name']) {
    $image = $_FILES['deal_image']['name'];
    $tmp = $_FILES['deal_image']['tmp_name'];
    move_uploaded_file($tmp, "upload/" . $image);
  }

  $query = "UPDATE deal_of_the_day SET
    deal_title = '$title',
    deal_description = '$desc',
    deal_net_price = '$net',
    deal_discounted_price = '$disc',
    available_deal = '$avail',
    sold_deal = '$sold',
    deal_image = '$image',
    deal_end_date = '$end_date'
    WHERE deal_id = $id";

  mysqli_query($conn, $query);
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
    <h1>Edit Deal</h1>
    <form class="row g-3" method="POST" enctype="multipart/form-data">
      <div class="col-md-6">
        <label class="form-label">Title</label>
        <input type="text" name="deal_title" class="form-control" value="<?php echo $deal['deal_title']; ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Description</label>
        <textarea name="deal_description" class="form-control" required><?php echo $deal['deal_description']; ?></textarea>
      </div>
      <div class="col-md-6">
        <label class="form-label">Net Price</label>
        <input type="number" step="0.01" name="deal_net_price" class="form-control" value="<?php echo $deal['deal_net_price']; ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Discounted Price</label>
        <input type="number" step="0.01" name="deal_discounted_price" class="form-control" value="<?php echo $deal['deal_discounted_price']; ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Available Deals</label>
        <input type="number" name="available_deal" class="form-control" value="<?php echo $deal['available_deal']; ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Sold Deals</label>
        <input type="number" name="sold_deal" class="form-control" value="<?php echo $deal['sold_deal']; ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">End Date/Time</label>
        <input type="datetime-local" name="deal_end_date" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($deal['deal_end_date'])); ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Current Image</label><br>
        <img src="upload/<?php echo $deal['deal_image']; ?>" width="100"><br><br>
        <input type="file" name="deal_image" class="form-control">
      </div>
      <div class="col-12">
        
      </div>
      <div class="col-12">
        <button type="submit" name="submit" class="btn btn-success w-100">Update Deal</button>
      </div>
    </form>
  </div>
</div>
