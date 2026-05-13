<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
?>

<h1>Products</h1>
<hr>

<div class="table-cont">
    <!-- Add Product Button -->
    <div class="add-product-btn">
        <a href="add-post.php" class="btn btn-primary">+ Add New Product</a>
    </div>
    
    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success">Product deleted successfully!</div>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Author</th>
                <th scope="col">List</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            include "includes/config.php"; 

            /* define how much data to show in a page from database*/
            $limit = 10;
            if(isset($_GET['page'])){
                $page = $_GET['page'];
                switch($page){
                    case 1: $sn = 0; break;
                    case 2: $sn = 4;break;
                    case 3: $sn = 8; break;
                    case 4: $sn = 12; break;
                    case 5: $sn = 16; break;
                    case 6: $sn = 20; break;
                }
            }else{
                $page = 1;
                switch($page){
                    case 1: $sn = 0; break;
                    case 2: $sn = 4;break;
                    case 3: $sn = 8; break;
                    case 4: $sn = 12; break;
                    case 5: $sn = 16; break;
                    case 6: $sn = 20; break;
                }
            }

            $offset = ($page - 1) * $limit;

            if($_SESSION["customer_role"] == 'admin'){
                $sql = "SELECT * FROM products ORDER BY product_id DESC LIMIT {$offset},{$limit}";
            }elseif($_SESSION["user_role"] == 'normal'){
                $sql = "SELECT * FROM products WHERE product_author='{$_SESSION['customer_name']}' ORDER BY product_id DESC LIMIT {$offset},{$limit}";
            }

            $result = $conn->query($sql) or die("Query Failed.");
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $sn = $sn+1;
            ?>
                <tr>
                    <th scope="row"><?php echo $sn?></th>
                    <td><?php echo $row["product_title"] ?></td>
                    <td><?php echo $row["product_catag"] ?></td>
                    <td><?php echo $row["product_author"] ?></td>
                    <td><?php echo $row["post_type"] ?></td>
                    <td>
                        <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                            <!-- Edit Button -->
                            <a href="update-post.php?id=<?php echo $row["product_id"] ?>" class="btn btn-info btn-sm">Edit</a>

                            <!-- Delete Button with Confirmation -->
                            <a href="remove-post.php?id=<?php echo $row["product_id"] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Are you sure you want to permanently delete this product?');">
                               Delete
                            </a>
                        </div>
                    </td>
                </tr>
            <?php 
                }} else { 
                    echo "<tr><td colspan='6'>No products found.</td></tr>";
                }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<br>

<!-- Pagination -->
<?php
    include "includes/config.php"; 

    $sql1 = "SELECT * FROM products";
    $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

    if(mysqli_num_rows($result1) > 0){
        $total_products = mysqli_num_rows($result1);
        $total_page = ceil($total_products / $limit);

?>
    <nav aria-label="..." style="margin-left: 10px;">
        <ul class="pagination pagination-sm">
            <?php 
                for($i=1; $i<=$total_page; $i++){
                    if ($page==$i) {
                        $active = "active";
                    } else {
                        $active = "";
                    }
            ?>
            <li class="page-item">
                <a class="page-link <?php echo $active; ?>" href="post.php?page=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a>
            </li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>
