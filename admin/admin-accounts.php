<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
    if (!(isset($_SESSION['logged-in']))) {
        header("Location:login.php?unauthorizedAccess");
    }
?>

<h1>Admin Accounts</h1>
<hr>
<a href="add-admin.php" class="btn btn-primary mb-3">Add New Admin</a>

<?php
    include "includes/config.php";

    $limit = 4;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $sn = ($page - 1) * $limit;
    $offset = $sn;

    $sql = "SELECT * FROM customer WHERE customer_role = 'admin' LIMIT {$offset}, {$limit}";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
?>

<div class="table-cont">
    <table class="table">
        <thead>
            <tr>
                <th>S.No</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Role</th><th>Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
        <?php while ($row = $result->fetch_assoc()) { $sn++; ?>
            <tr>
                <td><?= $sn ?></td>
                <td><?= $row["customer_fname"] ?></td>
                <td><?= $row["customer_email"] ?></td>
                <td><?= $row["customer_phone"] ?></td>
                <td><?= $row["customer_address"] ?></td>
                <td><?= $row["customer_role"] ?></td>
                <td>
                    <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                    <a href="verify-admin-password.php?id=<?= $row['customer_id'] ?>" class="btn btn-info btn-sm">Edit</a>

                        <?php if ($row["status"] == 1): ?>
                            <a href="verify-admin-archive.php?id=<?= $row["customer_id"] ?>" class="btn btn-warning btn-sm">Archive</a>
                        <?php else: ?>
                            <a href="verify-admin-reactivate.php?id=<?= $row["customer_id"] ?>" class="btn btn-success btn-sm">Reactivate</a>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- Pagination -->
<?php
    $sql1 = "SELECT * FROM customer WHERE customer_role = 'admin'";
    $result1 = mysqli_query($conn, $sql1);
    $total_admins = mysqli_num_rows($result1);
    $total_page = ceil($total_admins / $limit);
?>
<nav aria-label="..." style="margin-left: 10px;">
    <ul class="pagination pagination-sm">
        <?php for ($i = 1; $i <= $total_page; $i++) {
            $active = ($page == $i) ? "active" : "";
        ?>
        <li class="page-item"><a class="page-link <?= $active ?>" href="admin-accounts.php?page=<?= $i ?>"><?= $i ?></a></li>
        <?php } ?>
    </ul>
</nav>
<?php } else { echo "No admin accounts found."; } ?>
