<?php
ob_start();  // Start output buffering
include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include "includes/config.php";

if (isset($_POST['update'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($new_password) || !empty($confirm_password)) {
        if ($new_password !== $confirm_password) {
            $error = "New password and confirm password do not match.";
        } else {
            $sql = "UPDATE customer 
                    SET customer_fname='$name',
                        customer_phone='$phone',
                        customer_address='$address',
                        customer_pwd='$new_password'
                    WHERE customer_id={$_GET['id']}";

            if ($conn->query($sql)) {
                $success = "Admin updated successfully with new password.";
            } else {
                $error = "Error updating admin: " . $conn->error;
            }
        }
    } else {
        $sql = "UPDATE customer 
                SET customer_fname='$name',
                    customer_phone='$phone',
                    customer_address='$address'
                WHERE customer_id={$_GET['id']}";

        if ($conn->query($sql)) {
            $success = "Admin updated successfully (password unchanged).";
        } else {
            $error = "Error updating admin: " . $conn->error;
        }
    }
}

// Get previous data (even after update)
$sql = "SELECT * FROM customer WHERE customer_id={$_GET['id']}";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$_SESSION['previous_name'] = $row['customer_fname'];
$_SESSION['previous_phone'] = $row['customer_phone'];
$_SESSION['previous_address'] = $row['customer_address'];
$_SESSION['previous_role'] = $row['customer_role'];

$conn->close();
?>

<head>
    <style>
        .content-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: auto;
            padding: 30px 0;
        }

        .update {
            border: 1px solid black;
            width: 60%;
            padding: 25px;
            border-radius: 16px;
            background-color: #f1f1f1;
        }

        .error-msg {
            color: red;
            font-weight: bold;
        }

        .success-msg {
            color: green;
            font-weight: bold;
        }
    </style>
</head>

<div class="content-box">
    <div class="update">
        <h1>Update Admin Details</h1>
        <form class="row g-3" action="" method="POST">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input name="name" type="text" class="form-control" value="<?php echo $_SESSION['previous_name'] ?>" required />
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="number" name="phone" class="form-control" value="<?php echo $_SESSION['previous_phone'] ?>" required />
            </div>
            <div class="col-12">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $_SESSION['previous_address'] ?>" required />
            </div>
            <div class="col-md-6">
                <label class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-control" placeholder="New Password" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" />
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </div>

            <?php if (isset($error)) { ?>
                <div class="col-12 error-msg"><?php echo $error; ?></div>
            <?php } elseif (isset($success)) { ?>
                <div class="col-12 success-msg"><?php echo $success; ?><br>Redirecting to admin-accounts page...</div>
                <script>
                    setTimeout(() => {
                        window.location.href = "admin-accounts.php";
                    }, 2000);
                </script>
            <?php } ?>
        </form>
    </div>
</div>

<?php ob_end_flush(); ?>
