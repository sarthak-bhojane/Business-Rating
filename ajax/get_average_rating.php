<?php
include '../config/db.php';

$business_id = $_POST['business_id'];

$result = $conn->query("SELECT AVG(rating) as avg_rating 
FROM ratings WHERE business_id=$business_id");

if($result) {
    $row = $result->fetch_assoc();
    $avg = isset($row['avg_rating']) && $row['avg_rating'] !== NULL ? round($row['avg_rating'],1) : 0;
} else {
    $avg = 0;
}

echo $avg;
?>