<?php
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
?>

<h1>Category Bar Management</h1>
<hr>

<div class="table-cont">
    <!-- Add New Category Button -->
    <div class="add-category-btn">
        <a href="add-category-bar.php" class="btn btn-primary">Add New Category</a>
    </div>
    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success">Category bar item deleted successfully!</div>
<?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Category Title</th>
                <th scope="col"></th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            include "includes/config.php";

            // Fetch categories
            $sql = "SELECT * FROM category_bar";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $sn = 0;
                while($row = $result->fetch_assoc()) {
                    $cat_id = $row['id'];
                    $cat_title = $row['category_title'];
                  
                    

                    $sn++;
            ?>
                    <tr>
                        <th scope="row"><?php echo $sn; ?></th>
                        <td><?php echo $cat_title; ?></td>
                        
                        <td>
                
                        </td>
                        <td>
                            <!-- Edit category -->
                            <a href="edit-category-bar.php?id=<?php echo $cat_id; ?>" class="btn btn-info btn-sm">Edit</a>

                            <!-- Archive/Reactivate category -->
                            <!-- Delete Button with Confirmation -->
<a href="delete-category-bar.php?id=<?php echo $cat_id; ?>" 
   class="btn btn-danger btn-sm" 
   onclick="return confirm('Are you sure you want to permanently delete this category bar item?');">
   Delete
</a>

                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='5'>No categories found.</td></tr>";
            }

            $conn->close(); // Close the connection
            ?>
        </tbody>
    </table>
</div>
<br>
