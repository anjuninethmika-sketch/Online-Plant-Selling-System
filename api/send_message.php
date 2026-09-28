<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $name = $data['name'];
    $email = $data['email'];
    $message = $data['message'];
    $phone = $data['phone'];
    $subject = $data['subject'];

    $sql = "INSERT INTO contact_messages (name, email, message, phone, subject) 
            VALUES ('$name', '$email', '$message', '$phone', '$subject')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Message sent successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
}
?>