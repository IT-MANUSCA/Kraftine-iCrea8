<?php
include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include_once('./includes/config.php');

$query = "SELECT * FROM orders WHERE archived = 1 ORDER BY order_id DESC";
$result = mysqli_query($conn, $query);
?>

<h1>Trash Bin (Archived Orders)</h1>
<hr>

<div class="table-cont">
  <!-- Prompt for password before deleting all archived orders -->
  <form action="delete_all.php" method="POST">
    <button type="submit" class="btn btn-danger mb-3">Delete All Archived Orders</button>
  </form>

  <table class="table">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Customer Name</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Total Amount</th>
        <th>Shipping Fee</th>
        <th>Order Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['order_id']; ?></td>
          <td><?php echo $row['fullname']; ?></td>
          <td><?php echo $row['contact']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td>₱<?php echo $row['total_amount']; ?></td>
          <td>₱<?php echo $row['shipping_fee']; ?></td>
          <td><?php echo $row['order_date']; ?></td>
          <td>
            <!-- Reactivate Button -->
            <a href="reactivate_order.php?id=<?php echo $row['order_id']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Reactivate this archived order?')">Reactivate</a>
            
            <!-- Delete Button -->
            <a href="delete_archived_order.php?id=<?php echo $row['order_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this archived order?')">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
