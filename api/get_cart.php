<?php
include '../db_connect.php';

$user_id = $_GET['user_id'];
$sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
$result = $conn->query($sql);

$cart = [];
while($row = $result->fetch_assoc()) {
    $cart[] = $row;
}
echo json_encode($cart);
?>