<?php
include 'db_connect.php';

header("Content-Type: application/json");

$sql = "SELECT * FROM blog_posts";
$result = $conn->query($sql);

$posts = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

echo json_encode($posts);
?>