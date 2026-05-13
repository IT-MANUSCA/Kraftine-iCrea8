<?php
ob_start();  // Start output buffering

include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');

// This will provide previous category value before updating 
include "includes/config.php";
$sql = "SELECT * FROM category WHERE id={$_GET['id']}";
$result = $conn->query($sql);
// output data of each row
$row = $result->fetch_assoc();
$_SESSION['previous_category_name'] = $row['name'];
$conn->close();
?>

<head>
    <style>
        .content-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }
        .update {
            border: 1px solid black;
            width: 60%;
            padding: 25px;
            border-radius: 16px;
            background-color: #f1f1f1;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
        }
    </style>
</head>

<div class="content-box">
    <div class="update">
        <h1>Update Category Name</h1>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="col-md-12">
                <label for="category_name" class="form-label">Category Name</label>
                <input 
                    name="category_name" 
                    type="text" 
                    class="form-control"
                    value="<?php echo $_SESSION['previous_category_name'] ?>" 
                    required
                />
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['update'])) {
    // Update category name in the database
    include "includes/config.php";
    $updated_name = $_POST['category_name'];

    // SQL query to update category name
    $sql1 = "UPDATE category 
             SET name = '{$updated_name}' 
             WHERE id = {$_GET['id']}";

    if ($conn->query($sql1)) {
        // Redirect after the update
        header("Location: category.php?updated=success");
        exit;  // Make sure the script ends here after the redirect
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

ob_end_flush();  // End output buffering and flush the output
?>
