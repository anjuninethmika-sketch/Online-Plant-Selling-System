<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');


if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $conn->query("SELECT * FROM products WHERE id = $id");
    $product = $query->fetch_assoc();

    if($product) {
        echo "<h2>".$product['name']."</h2>";
        echo "<p style='color: #2e7d32; font-weight: bold;'>Price: Rs. ".number_format($product['price'], 2)."</p>";
        echo "<p style='margin: 15px 0;'>".$product['description']."</p>";
        echo "<a href='cart.php?add=".$product['id']."' style='background:#2e7d32; color:white; padding:10px 20px; text-decoration:none; border-radius:5px;'>Add to Cart</a>";
    } else {
        echo "Product not found.";
    }
}
?>