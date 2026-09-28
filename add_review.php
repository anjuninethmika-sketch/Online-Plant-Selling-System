<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');

if (isset($_POST['submit'])) {
    $pid = $_POST['product_id'];
    $name = $_SESSION['user_name'] ?? 'Guest';
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO reviews (product_id, user_name, rating, comment) VALUES ('$pid', '$name', '$rating', '$comment')";
    $conn->query($sql);
    header("Location: product/view.php?id=$pid");
}
?>