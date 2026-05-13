<?php
include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include_once('./includes/config.php');

$query = "SELECT * FROM deal_of_the_day ORDER BY deal_id DESC";
$result = mysqli_query($conn, $query);
?>

<h1>Deal of the Day Management</h1>
<hr>

<div class="table-cont">
  <div class="add-category-btn">
    <a href="deal_add.php" class="btn btn-primary">+ Add New Deal</a>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Net Price</th>
        <th>Discount Price</th>
        <th>Available</th>
        <th>Sold</th>
        <th>Image</th>
        <th></th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['deal_id']; ?></td>
          <td><?php echo $row['deal_title']; ?></td>
          <td><?php echo $row['deal_description']; ?></td>
          <td>₱<?php echo $row['deal_net_price']; ?></td>
          <td>₱<?php echo $row['deal_discounted_price']; ?></td>
          <td><?php echo $row['available_deal']; ?></td>
          <td><?php echo $row['sold_deal']; ?></td>
          <td><img src="upload/<?php echo $row['deal_image']; ?>" width="100"></td>
          <td>
            
          </td>
          <td>
            <a href="deal_edit.php?id=<?php echo $row['deal_id']; ?>" class="btn btn-info btn-sm">Edit</a>
            <a href="deal_delete.php?id=<?php echo $row['deal_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this deal?')">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
