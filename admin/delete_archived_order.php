<?php
ob_start(); // Start output buffering
session_start();

include_once('./includes/headerNav.php');
include_once('./includes/config.php');

if (!isset($_SESSION['logged-in'])) {
    header("Location: login.php?unauthorizedAccess");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "No order specified for deletion.";
    exit;
}

$order_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['admin_password']) || empty($_POST['admin_password'])) {
        $error = "Password required.";
    } else {
        $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);

        $query = "SELECT * FROM admins WHERE admin_id = 1";
        $result = mysqli_query($conn, $query);
        $admin = mysqli_fetch_assoc($result);

        if ($admin && password_verify($admin_password, $admin['admin_password'])) {
            $delete_query = "DELETE FROM orders WHERE order_id = $order_id AND archived = 1";
            if (mysqli_query($conn, $delete_query)) {
                $success = "Archived order deleted successfully.";
            } else {
                $error = "Error deleting the order: " . mysqli_error($conn);
            }
        } else {
            $error = "Incorrect password. Please try again.";
        }
    }
}
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
    </style>
</head>

<div class="content-box">
    <div class="update">
        <h2 class="text-center">Verify Admin Password to Delete Archived Order</h2>
        <form method="POST" class="row g-3">

            <div class="col-12">
                <label for="admin_password" class="form-label">Enter Admin Password:</label>
                <input type="password" name="admin_password" class="form-control" required>
            </div>

            <div class="col-12 d-flex justify-content-between">
                <button type="submit" class="btn btn-danger">Delete Order</button>
                <a href="archived-orders.php" class="btn btn-secondary">Cancel</a>
            </div>

            <?php if (isset($error)) { ?>
                <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
            <?php } ?>
            
            <?php if (isset($success)) { ?>
                <div class="alert alert-success mt-3"><?php echo $success; ?></div>
            <?php } ?>

        </form>
    </div>
</div>

<?php
ob_end_flush(); // End output buffering and flush output
?>
