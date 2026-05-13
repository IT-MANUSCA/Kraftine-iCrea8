<?php
    ob_start();  // Start output buffering

    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');

    // Check if user is logged in
    if (!(isset($_SESSION['logged-in']))) {
        header("Location: login.php?unauthorizedAccess");
        exit;
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
        <h1 class="text-center">Add New Admin</h1>
        <form action="process-add-user.php" method="post" enctype="multipart/form-data" class="row g-3">
            
            <div class="col-md-12">
                <label for="fname" class="form-label">Full Name</label>
                <input type="text" name="fname" class="form-control" required>
            </div>


            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="col-12">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>

            <div class="col-md-4">
                <label for="role" class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="col-12">
                <input type="submit" value="Add Admin" class="btn btn-success">
            </div>

        </form>
    </div>
</div>

<?php
    ob_end_flush();  // End output buffering and flush the output
?>
