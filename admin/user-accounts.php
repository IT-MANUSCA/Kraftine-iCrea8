<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
    if (!(isset($_SESSION['logged-in']))) {
        header("Location:login.php?unauthorizedAccess");
    }
?>

<h1>User Accounts</h1>
<hr>
<a href="add-user.php" class="btn btn-primary mb-3">Add New User</a>

<?php
    include "includes/config.php";

    $limit = 4;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $sn = ($page - 1) * $limit;
    $offset = $sn;

    $sql = "SELECT * FROM customer WHERE customer_role = 'normal' LIMIT {$offset}, {$limit}";
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
                    <a href="change-password.php?id=<?= $row['customer_id'] ?>" class="btn btn-secondary btn-sm">Change Password</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- Pagination -->
<?php
    $sql1 = "SELECT * FROM customer WHERE customer_role = 'normal'";
    $result1 = mysqli_query($conn, $sql1);
    $total_users = mysqli_num_rows($result1);
    $total_page = ceil($total_users / $limit);
?>
<nav aria-label="..." style="margin-left: 10px;">
    <ul class="pagination pagination-sm">
        <?php for ($i = 1; $i <= $total_page; $i++) {
            $active = ($page == $i) ? "active" : "";
        ?>
        <li class="page-item"><a class="page-link <?= $active ?>" href="user-accounts.php?page=<?= $i ?>"><?= $i ?></a></li>
        <?php } ?>
    </ul>
</nav>
<?php } else { echo "No user accounts found."; } ?>
