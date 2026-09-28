<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $user_id = $data['user_id'];
    $product_id = $data['product_id'];
    $quantity = $data['quantity'];
    $user_email = $data['user_email'];
    $product_name = $data['product_name'];
    $price = $data['price'];

    $sql = "INSERT INTO cart (user_id, product_id, quantity, user_email, product_name, price) 
            VALUES ('$user_id', '$product_id', '$quantity', '$user_email', '$product_name', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Item added to cart!"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
}
?>