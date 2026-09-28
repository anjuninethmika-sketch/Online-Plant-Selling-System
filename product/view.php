<?php 
session_start();
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $conn->query("SELECT * FROM products WHERE id = $id");
    $product = $query->fetch_assoc();
} else {
    header("Location: ../shop.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <title><?php echo $product['name']; ?> | Bloom & Branch</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4fcf4; margin: 0; padding: 20px; }
        
        .product-container { 
            max-width: 900px; 
            margin: 50px auto; 
            background: white; 
            padding: 40px; 
            border-radius: 20px; 
            display: flex; 
            gap: 40px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            align-items: center; 
        }
        
        .img-box { flex: 1; text-align: center; }
        .img-box img { 
            max-width: 100%; 
            width: 350px; 
            height: 350px; 
            object-fit: cover; 
            border-radius: 15px; 
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .details-box { flex: 1; }
        h1 { color: #2e7d32; margin-top: 0; }
        .price { font-size: 24px; font-weight: bold; color: #2e7d32; margin: 15px 0; }
        .btn-add { background: #2e7d32; color: white; padding: 12px 25px; border-radius: 8px; text-decoration: none; display: inline-block; font-weight: bold; }
        .btn-back { display: inline-block; margin-bottom: 20px; color: #666; text-decoration: none; }
        
        /* Review Section Styles */
        .review-section { max-width: 900px; margin: 20px auto; background: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .review-form textarea { width: 100%; height: 80px; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        .review-form button { background: #2e7d32; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        .single-review { border-bottom: 1px solid #eee; padding: 15px 0; }
        
        .login-prompt {
            background: #e8f5e9;
            padding: 15px;
            border-radius: 10px;
            border-left: 5px solid #2e7d32;
            margin-bottom: 15px;
        }
        .login-prompt a { color: #2e7d32; font-weight: bold; text-decoration: none; }
    </style>
</head>
<body>

<div class="product-container">
    <div class="img-box">
        <img src="../images/<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
    </div>
    
    <div class="details-box">
        <a href="../shop.php" class="btn-back">← Back to Shop</a>
        <h1><?php echo $product['name']; ?></h1>
        <p class="price">Rs. <?php echo number_format($product['price'], 2); ?></p>
        <p style="color: #555; line-height: 1.6;"><?php echo $product['description']; ?></p>
        
        <div style="margin: 20px 0;">
            <a href="../cart.php?add=<?php echo $product['id']; ?>" class="btn-add">Add to Cart</a>
        </div>
    </div>
</div>

<!-- Review Section -->
<div class="review-section">
    <h3>Customer Reviews</h3>
    
    <?php if(isset($_SESSION['user_name'])): ?>
        <form action="../add_review.php" method="POST" class="review-form">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <label>Rating:</label>
            <select name="rating">
                <option value="5">5 ⭐</option>
                <option value="4">4 ⭐</option>
                <option value="3">3 ⭐</option>
                <option value="2">2 ⭐</option>
                <option value="1">1 ⭐</option>
            </select>
            <textarea name="comment" placeholder="Write your review here..." required></textarea>
            <button type="submit" name="submit">Submit Review</button>
        </form>
    <?php else: ?>
        <div class="login-prompt">
            <p>Would you like to add your review? Please <a href="../login.php">Login</a>.</p>
        </div>
    <?php endif; ?>

    <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

    <?php
    $pid = $product['id'];
    $rev_sql = "SELECT * FROM reviews WHERE product_id = $pid ORDER BY created_at DESC";
    $rev_res = $conn->query($rev_sql);

    if($rev_res->num_rows > 0) {
        while($r = $rev_res->fetch_assoc()) {
            echo "<div class='single-review'>
                    <strong>".htmlspecialchars($r['user_name'])."</strong> - ".$r['rating']." ⭐<br>
                    <p>".htmlspecialchars($r['comment'])."</p>
                  </div>";
        }
    } else {
        echo "<p>No reviews yet. Be the first to review!</p>";
    }
    ?>
</div>

</body>
</html>