<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    
    $product_id = $data['product_id'];
    $user_name = $data['user_name'];
    $rating = $data['rating'];
    $comment = $data['comment'];

    
    $sql = "INSERT INTO reviews (product_id, user_name, rating, comment) 
            VALUES ('$product_id', '$user_name', '$rating', '$comment')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Review added successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
}
?>