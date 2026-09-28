<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    
    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];
    $discount_price = $data['discount_price'];
    $category = $data['category'];
    $image_url = $data['image_url'];
    $light_info = $data['light_info'];
    $water_info = $data['water_info'];
    $care_tips = $data['care_tips'];
    $stock_status = $data['stock_status'];

    $sql = "INSERT INTO products (name, description, price, discount_price, category, image_url, light_info, water_info, care_tips, stock_status) 
            VALUES ('$name', '$description', '$price', '$discount_price', '$category', '$image_url', '$light_info', '$water_info', '$care_tips', '$stock_status')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Product added successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
}
?>