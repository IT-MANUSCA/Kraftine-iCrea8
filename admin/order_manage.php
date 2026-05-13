<?php
include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include_once('./includes/config.php');

$query = "SELECT * FROM orders WHERE archived = 0 ORDER BY order_id DESC";
$result = mysqli_query($conn, $query);
?>

<h1>Order Management</h1>
<hr>

<!-- Button to View Archived Orders -->
<div class="d-flex justify-content-between mb-3">
  <div>
    <a href="view_archived_orders.php" class="btn btn-secondary">View Archived Orders</a>
  </div>
  <div>
 
  </div>
</div>

<div class="table-cont">
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
        <th>Order Status</th>
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
            <form action="update_order_status.php" method="POST">
              <select name="status" class="form-select" required>
                <option value="Pending" <?php if($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="On the Way" <?php if($row['status'] == 'On the Way') echo 'selected'; ?>>On the Way</option>
                <option value="Delivered" <?php if($row['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                <option value="Received" <?php if($row['status'] == 'Received') echo 'selected'; ?>>Received</option>
                <option value="Cancelled" <?php if($row['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
              </select>
              <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
              <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </form>
          </td>
          <td>
            <a href="order_archive.php?id=<?php echo $row['order_id']; ?>" class="btn btn-warning btn-sm">Archive</a>
            <a href="view_order.php?id=<?php echo $row['order_id']; ?>" class="btn btn-info btn-sm">View</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

