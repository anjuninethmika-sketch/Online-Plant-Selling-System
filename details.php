<?php
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $conn->query("SELECT * FROM products WHERE id = $id");
    $product = $query->fetch_assoc();
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $product['name']; ?> | GreenShop</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f9f9f9; padding: 40px; }
        .details-container { max-width: 900px; margin: auto; background: white; padding: 30px; border-radius: 15px; display: flex; gap: 40px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .img-side { flex: 1; }
        .img-side img { width: 100%; border-radius: 10px; }
        .info-side { flex: 1; }
        h1 { color: #1a2f24; margin-top: 0; }
        .price { font-size: 26px; color: #27ae60; font-weight: bold; margin: 10px 0; }
        .desc { color: #666; line-height: 1.6; margin-bottom: 20px; }
        .plant-specs { background: #f4f7f6; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .btn { display: inline-block; padding: 15px 40px; background: #27ae60; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; border: none; cursor: pointer; }
        .qty-input { width: 50px; padding: 10px; margin-right: 10px; border: 1px solid #ddd; border-radius: 5px; }
    </style>
</head>
<body>

<div class="details-container">
    <?php if($product): ?>
        <div class="img-side">
            <img src="images/<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
        </div>
        
        <div class="info-side">
            <h1><?php echo $product['name']; ?></h1>
            <p class="price">Rs. <?php echo $product['price']; ?></p>
            <p class="desc"><?php echo $product['description']; ?></p>
            
            <div class="plant-specs">
                <p><strong>Light:</strong> <?php echo $product['light_info'] ?? 'Not specified'; ?></p>
                <p><strong>Water:</strong> <?php echo $product['water_info'] ?? 'Not specified'; ?></p>
                <p><strong>Size:</strong> <?php echo $product['size_info'] ?? 'Not specified'; ?></p>
            </div>
            
            <form action="cart.php" method="GET">
                <input type="hidden" name="add" value="<?php echo $product['id']; ?>">
                <input type="number" name="quantity" value="1" min="1" class="qty-input">
                <button type="submit" class="btn">Add to Cart</button>
            </form>
        </div>
    <?php else: ?>
        <h2>Product not found!</h2>
    <?php endif; ?>
</div>

</body>
</html>