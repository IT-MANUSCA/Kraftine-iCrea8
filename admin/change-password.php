<?php
include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include "includes/config.php";

if (!(isset($_SESSION['logged-in']))) {
    header("Location: login.php?unauthorizedAccess");
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid user ID.";
    exit();
}

$user_id = $_GET['id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($new_password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = "UPDATE customer SET customer_password='$hashed_password' WHERE customer_id='$user_id'";
        if (mysqli_query($conn, $sql)) {
            $success = "Password updated successfully.";
        } else {
            $error = "Error updating password: " . mysqli_error($conn);
        }
    }
}

// Get user info for display (optional)
$sql = "SELECT customer_fname, customer_email FROM customer WHERE customer_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<div class="container mt-5">
    <h2>Change Password for <?= htmlspecialchars($user['customer_fname']) ?> (<?= $user['customer_email'] ?>)</h2>
    <hr>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if (isset($success)) : ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group mb-3">
            <label for="new_password">New Password</label>
            <input type="password" name="new_password" class="form-control" required minlength="6">
        </div>
        <div class="form-group mb-3">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" required minlength="6">
        </div>
        <button type="submit" class="btn btn-primary">Update Password</button>
        <a href="user-accounts.php" class="btn btn-secondary">Back</a>
    </form>
</div>

