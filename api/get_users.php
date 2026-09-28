<?php
include '../db_connect.php';

$sql = "SELECT id, username, email, role, address, phone, name FROM users"; // Password එක පෙන්වන්නේ නැතිව අනිත් දත්ත ගන්න
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
echo json_encode($users);
?>