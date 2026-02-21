<?php
include '../config/db.php';

$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$conn->query("INSERT INTO businesses (name,address,phone,email)
VALUES ('$name','$address','$phone','$email')");

echo "success";
?>