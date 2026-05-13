<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
    include "includes/config.php";

    if (!isset($_GET['id'])) {
        die("Product ID is required");
    }

    $product_id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE product_id = {$product_id}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>

<head>
    <style>
        .content-box-post {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 50px 0;
        }
        .update {
            border: 1px solid black;
            width: 80%;
            padding: 25px;
            border-radius: 16px;
            background-color: #f1f1f1;
        }
    </style>
</head>

<div class="content-box-post">
    <div class="update">
        <h5>Edit Product</h5>
        <form action="" method="POST" class="row g-3" enctype="multipart/form-data">
            <div class="col-12">
                <label class="form-label">Title</label>
                <input class="form-control" type="text" name="title" value="<?php echo htmlspecialchars($row['product_title']); ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Price</label>
                <input class="form-control" type="number" name="price" value="<?php echo $row['product_price']; ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Discount</label>
                <input class="form-control" type="number" name="discount" value="<?php echo $row['discounted_price']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" rows="3" name="desc"><?php echo htmlspecialchars($row['product_desc']); ?></textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">No. of Items</label>
                <input class="form-control" type="number" name="noofitem" value="<?php echo $row['product_left']; ?>" required>
            </div>

            <div class="col-md-6">
    <label class="form-label">Category</label>
    <select name="catag" class="form-select" required>
        <?php
            include "includes/config.php";
            $cat_sql = "SELECT * FROM category WHERE id";
            $cat_result = mysqli_query($conn, $cat_sql);

            if (mysqli_num_rows($cat_result) > 0) {
                while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                    $selected = ($cat_row['name'] == $row['product_catag']) ? "selected" : "";
                    echo "<option value='{$cat_row['name']}' $selected>{$cat_row['name']}</option>";
                }
            } else {
                echo "<option disabled>No categories available</option>";
            }
        ?>
    </select>
</div>


            <div class="col-12">
                <label class="form-label">Image</label>
                <input type="file" name="newimg" class="form-control">
                <small>Current: <?php echo $row['product_img']; ?></small>
            </div>

            <div class="col-12">
                <label class="form-label d-block">Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="Available" id="available"
                        <?php if ($row['status'] == 'Available') echo 'checked'; ?>>
                    <label class="form-check-label" for="available">Available</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="Unavailable" id="unavailable"
                        <?php if ($row['status'] == 'Unavailable') echo 'checked'; ?>>
                    <label class="form-check-label" for="unavailable">Unavailable</label>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['update'])) {
    include "includes/config.php";

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $catag = mysqli_real_escape_string($conn, $_POST['catag']);
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $noofitem = $_POST['noofitem'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Handle image upload
    if (!empty($_FILES['newimg']['name'])) {
        $image_name = basename($_FILES['newimg']['name']);
        $target_dir = "images/";
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES['newimg']['tmp_name'], $target_file)) {
            $image_to_save = $image_name;
        } else {
            echo "<script>alert('Image upload failed.');</script>";
            $image_to_save = $row['product_img'];
        }
    } else {
        $image_to_save = $row['product_img'];
    }

    $sql_update = "UPDATE products SET 
        product_title = '$title',
        product_catag = '$catag',
        product_price = '$price',
        discounted_price = '$discount',
        product_desc = '$desc',
        product_img = '$image_to_save',
        product_left = '$noofitem',
        status = '$status'
        WHERE product_id = $product_id";

    if ($conn->query($sql_update)) {
        echo "<script>window.location.href='post.php?successfullyUpdated';</script>";
        exit;
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
