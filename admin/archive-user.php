<?php
    include "includes/config.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "UPDATE customer SET status = 0 WHERE customer_id = {$id}";
        if ($conn->query($sql) === TRUE) {
            header("Location: admin-accounts.php?archived=true");
        } else {
            echo "Error: " . $conn->error;
        }
    }
    $conn->close();
?>
