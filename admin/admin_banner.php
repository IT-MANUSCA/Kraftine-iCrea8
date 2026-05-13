<?php
include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include_once('./includes/config.php'); // Ensure DB connection
?>

<?php
// Fetch all banners
$banner_query = "SELECT * FROM banner ORDER BY banner_id DESC";
$banner_result = mysqli_query($conn, $banner_query);
?>

<h1>Banner Management</h1>
<hr>

<div class="table-cont">
  <!-- Add Banner Button -->
  <div class="add-category-btn">
    <a href="banner_add.php" class="btn btn-primary">+ Add New Banner</a>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Subtitle</th>
        <th scope="col">Title</th>
        <th scope="col">Image</th>
        <th scope="col">Title Color</th>
        <th scope="col">Sub Color</th>
        <th scope="col"></th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <?php while ($row = mysqli_fetch_assoc($banner_result)) { ?>
        <tr>
          <th scope="row"><?php echo $row['banner_id']; ?></th>
          <td><?php echo $row['banner_subtitle']; ?></td>
          <td><?php echo $row['banner_title']; ?></td>
          <td><img src="../images/carousel/<?php echo $row['banner_image']; ?>" width="100"></td>
          <td><?php echo $row['banner_title_color']; ?></td>
          <td><?php echo $row['banner_subtitle_color']; ?></td>
          <td>
            
          </td>
          <td>
            <a href="banner_edit.php?id=<?php echo $row['banner_id']; ?>" class="btn btn-info btn-sm">Edit</a>
            <a href="banner_delete.php?id=<?php echo $row['banner_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this banner?')">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<br>


