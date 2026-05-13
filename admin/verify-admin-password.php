<?php
ob_start(); // Start output buffering

include_once('./includes/headerNav.php');
include_once('./includes/restriction.php');
include_once('./includes/config.php');

if (!isset($_SESSION['logged-in'])) {
    header("Location: login.php?unauthorizedAccess");
    exit;
}

if (!isset($_GET['id'])) {
    echo "No admin selected.";
    exit;
}

$target_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_password = $_POST['password'];

    $sql = "SELECT * FROM customer WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $target_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $adminData = $result->fetch_assoc();
        if ($entered_password === $adminData['customer_pwd']) {

            header("Location: update-user.php?id=" . $target_id);
            exit;
        } else {
            $error = "Incorrect password for this admin account.";
        }
    } else {
        $error = "Admin not found.";
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
        <h2 class="text-center">Verify Admin Password</h2>
        <form method="POST" class="row g-3">

            <div class="col-12">
                <label for="password" class="form-label">Enter Password of Admin You Are Trying to Edit:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="col-12 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Verify</button>
                <a href="admin-accounts.php" class="btn btn-secondary">Cancel</a>
            </div>

            <?php if (isset($error)) { ?>
                <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
            <?php } ?>

        </form>
    </div>
</div>

<?php
ob_end_flush(); // End output buffering and flush output
?>
