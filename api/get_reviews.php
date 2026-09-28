<?php
include '../db_connect.php';


$product_id = $_GET['product_id'];

$sql = "SELECT * FROM reviews WHERE product_id = '$product_id' ORDER BY created_at DESC";
$result = $conn->query($sql);

$reviews = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}
echo json_encode($reviews);
?>