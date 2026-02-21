<?php
include '../config/db.php';

$business_id = $_POST['business_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$rating = $_POST['rating'];

$check = $conn->query("SELECT id FROM ratings 
WHERE business_id=$business_id 
AND (email='$email' OR phone='$phone')");

if($check && $check->num_rows > 0){
    $row = $check->fetch_assoc();
    $update = $conn->query("UPDATE ratings SET rating='$rating' WHERE id=".$row['id']);
    error_log("Updated rating for id: " . $row['id']);
} else {
    $insert = $conn->query("INSERT INTO ratings (business_id,name,email,phone,rating)
    VALUES ('$business_id','$name','$email','$phone','$rating')");
    error_log("Inserted new rating for business_id: " . $business_id);
}

echo "success";
?>