<?php
include_once('./includes/config.php');
$id = $_GET['id'];

$query = "DELETE FROM deal_of_the_day WHERE deal_id = $id";
mysqli_query($conn, $query);

header("Location: deal_manage.php");
exit;
?>
