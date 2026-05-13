<?php
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
?>

<h1>Product Categories</h1>
<hr>

<div class="table-cont">
    <!-- Add Category Button -->
    <div class="add-category-btn">
        <a href="add_category.php" class="btn btn-primary">+ Add New Category</a>
    </div>
    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success">Category deleted successfully!</div>
<?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Category</th>
          
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            include "includes/config.php"; 

            // Fetch all categories (active and archived)
            $sql = "SELECT * FROM category";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Loop through each category
                while($row = $result->fetch_assoc()) {
                    $cat_name = $row['name'];
                    $cat_id = $row['id'];
                    

                    // Query to get the number of posts for this category
                    $sql_posts = "SELECT * FROM products WHERE product_catag = '{$cat_name}'";
                    $result_posts = $conn->query($sql_posts);
                   
                    // Display category information
                    ?>
                    <tr>
                        <th scope="row"><?php echo $cat_id; ?></th>
                        <td><?php echo $cat_name; ?></td>
                        
                        <td>
    <div style="display: flex; gap: 5px; flex-wrap: wrap;">
        <!-- Edit Button -->
        <a href="edit-category.php?id=<?php echo $cat_id; ?>" class="btn btn-info btn-sm">Edit</a>

        <!-- Delete Button with Confirmation -->
<a href="delete-category.php?id=<?php echo $cat_id; ?>" 
   class="btn btn-danger btn-sm" 
   onclick="return confirm('Are you sure you want to permanently delete this category?');">
   Delete
</a>

    </div>
</td>

                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='4'>No categories found.</td></tr>";
            }

            $conn->close(); // Close the connection
            ?>
        </tbody>
    </table>
</div>
<br>
