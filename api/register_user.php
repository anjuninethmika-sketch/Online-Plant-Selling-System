<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $username = $data['username'];
    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT); // Password එක ආරක්ෂිතව Hash කිරීම
    $role = $data['role'];
    $address = $data['address'];
    $phone = $data['phone'];
    $name = $data['name'];

    $sql = "INSERT INTO users (username, email, password, role, address, phone, name) 
            VALUES ('$username', '$email', '$password', '$role', '$address', '$phone', '$name')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "User registered successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
}
?>