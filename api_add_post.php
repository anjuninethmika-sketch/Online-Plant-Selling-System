<?php
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
    $data = json_decode(file_get_contents("php://input"), true);

    $title = $data['title'];
    $content = $data['content'];
    $image_path = $data['image_path'];
    $created_at = date('Y-m-d H:i:s'); 

    
    $sql = "INSERT INTO blog_posts (title, content, image_path, created_at) VALUES ('$title', '$content', '$image_path', '$created_at')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Post added successfully!"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["message" => "Invalid Request Method. Use POST."]);
}
?>