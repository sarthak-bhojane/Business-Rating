<?php
include '../config/db.php';

$id = $_POST['id'];
$conn->query("DELETE FROM businesses WHERE id=$id");

echo "deleted";
?>