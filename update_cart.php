<?php
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');
$id = $_GET['id'];
$action = $_GET['action'];

if($action == 'plus') {
    $conn->query("UPDATE cart SET quantity = quantity + 1 WHERE id = $id");
} elseif($action == 'minus') {
    $conn->query("UPDATE cart SET quantity = quantity - 1 WHERE id = $id AND quantity > 1");
} elseif($action == 'remove') {
    $conn->query("DELETE FROM cart WHERE id = $id");
}

header("Location: cart.php");
?>