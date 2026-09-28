<?php 
session_start(); 
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');

$search = $_GET['search'] ?? '';
$cat = $_GET['cat'] ?? '';


$sql = "SELECT * FROM products WHERE 1=1";
if($search != '') { $sql .= " AND name LIKE '%$search%'"; }
if($cat != '') { $sql .= " AND category LIKE '%$cat%'"; }

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <title>Shop | Bloom & Branch</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4fcf4; color: #333; }
        
        .navbar { background: #fff; padding: 20px 8%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,128,0,0.1); }
        .logo { font-size: 28px; font-weight: bold; color: #2e7d32; }
        .nav-links a { text-decoration: none; color: #1b5e20; margin-left: 25px; font-weight: 600; }

        .shop-container { display: flex; padding: 40px 8%; gap: 50px; }
        .sidebar { width: 220px; flex-shrink: 0; }
        .sidebar h3 { color: #1b5e20; margin-bottom: 20px; border-bottom: 2px solid #4caf50; padding-bottom: 10px; }
        .sidebar a { display: block; padding: 12px 15px; color: #444; text-decoration: none; border-radius: 5px; transition: 0.3s; margin-bottom: 5px; }
        .sidebar a:hover { background-color: #e8f5e9; color: #2e7d32; }
        .sidebar a.active { background-color: #2e7d32; color: white; font-weight: bold; }
        
        .search-box { margin-bottom: 30px; }
        .search-box input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; }
        .search-box button { background: #2e7d32; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px; width: 100%; }

        .product-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; flex: 1; }
        .product-card { background: white; padding: 20px; border-radius: 12px; border: 1px solid #c8e6c9; text-align: center; transition: 0.3s; position: relative; }
        .product-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0, 128, 0, 0.2); }
        .product-card img { width: 100%; height: 220px; object-fit: cover; border-radius: 8px; margin-bottom: 15px; }
        
        .discount-badge { position: absolute; top: 20px; left: 20px; background: #e74c3c; color: white; padding: 5px 12px; font-weight: bold; border-radius: 5px; font-size: 12px; z-index: 2; }
        .old-price { text-decoration: line-through; color: #888; font-size: 0.9em; margin-right: 10px; }
        
        .btn-add { background: #2e7d32; color: white; padding: 12px; border-radius: 6px; display: block; text-decoration: none; font-weight: bold; margin-bottom: 5px; }
        .btn-view { background: #607d8b; color: white; padding: 12px; border-radius: 6px; display: block; text-decoration: none; font-weight: bold; margin-bottom: 5px; }
        .btn-quick { background: #ffa000; color: white; padding: 8px; border-radius: 6px; display: block; text-decoration: none; font-weight: bold; border:none; width: 100%; cursor: pointer; }
        .btn-container {
    display: flex;
    flex-direction: column;
    gap: 8px; 
    margin-top: 15px;
}
    </style>
</head>
<body>

<nav class="navbar">
    <div class="logo">Bloom & Branch</div>
    <div class="nav-links">
        <a href="index.php">🏠 Home</a>
        <a href="shop.php">🌿 Shop</a>
        <a href="blog.php">📖 Blog</a>
        <a href="cart.php">🛒 My Cart</a>
        <?php if(isset($_SESSION['user_name'])): ?>
            <a href="track.php" style="color: #e67e22; font-weight: bold;">🚚 Track Order</a>
            <a href="logout.php">🚪 Logout</a>
        <?php endif; ?>
    </div>
</nav>

<div class="shop-container">
    <aside class="sidebar">
        <div class="search-box">
            <form method="GET" action="shop.php">
                <input type="text" name="search" placeholder="Search plants..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Search</button>
            </form>
        </div>
        <h3>Categories</h3>
        <a href="shop.php" class="<?php echo ($cat == '') ? 'active' : ''; ?>">🏠 All Products</a>
        <a href="shop.php?cat=Indoor" class="<?php echo ($cat == 'Indoor') ? 'active' : ''; ?>">🌿 Indoor Plants</a>
        <a href="shop.php?cat=Outdoor" class="<?php echo ($cat == 'Outdoor') ? 'active' : ''; ?>">☀️ Outdoor Plants</a>
        <a href="shop.php?cat=Flowering" class="<?php echo ($cat == 'Flowering') ? 'active' : ''; ?>">🌸 Flowering Plants</a>
        <a href="shop.php?cat=Hanging" class="<?php echo ($cat == 'Hanging') ? 'active' : ''; ?>">🪴 Hanging Plants</a>
        <a href="shop.php?cat=Succulents" class="<?php echo ($cat == 'Succulents') ? 'active' : ''; ?>">🌵 Succulents</a>
        <a href="shop.php?cat=Fertilizer" class="<?php echo ($cat == 'Fertilizer') ? 'active' : ''; ?>">🧪 Fertilizers</a>
        <a href="shop.php?cat=Pots" class="<?php echo ($cat == 'Pots') ? 'active' : ''; ?>">🏺 Pots</a>
    </aside>

    <main class="product-grid">
        <?php 
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()): 
                $has_discount = ($row['discount_price'] > 0);
        ?>
            <div class="product-card">
                <?php if ($has_discount): ?>
                    <div class="discount-badge">SALE!</div>
                <?php endif; ?>
                
                <a href="product/view.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color:inherit;">
                    <img src="images/<?php echo $row['image_url']; ?>" alt="Plant">
                    <h4 style="margin-top:10px;"><?php echo $row['name']; ?></h4>
                </a>
                
                <p style="color: #2e7d32; font-weight: bold; margin: 15px 0;">
                    <?php if ($has_discount): ?>
                        <span class="old-price">Rs. <?php echo number_format($row['price'], 2); ?></span>
                        Rs. <?php echo number_format($row['discount_price'], 2); ?>
                    <?php else: ?>
                        Rs. <?php echo number_format($row['price'], 2); ?>
                    <?php endif; ?>
                </p>
                
                
<div class="btn-container">
    <a href="product/view.php?id=<?php echo $row['id']; ?>" class="btn-view" style="margin-bottom: 0;">View Details</a>
    <button onclick="openModal(<?php echo $row['id']; ?>)" class="btn-quick" style="margin-bottom: 0;">Quick View</button>
    <a href="cart.php?add=<?php echo $row['id']; ?>" class="btn-add" style="margin-bottom: 0;">Add to Cart</a>
</div>
            </div>
        <?php endwhile; 
        } else {
            echo "<p style='grid-column: 1/-1; text-align: center; padding: 50px;'>Not found plants you choose.</p>";
        }
        ?>
    </main>
</div>

<div id="quickViewModal" style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
  <div style="background:white; margin:10% auto; padding:20px; width:50%; border-radius:10px; position:relative; box-shadow: 0 5px 15px rgba(0,0,0,0.3);">
    <span onclick="closeModal()" style="float:right; cursor:pointer; font-size:24px; font-weight:bold;">&times;</span>
    <div id="modalContent">Loading...</div>
  </div>
</div>

<script>
function openModal(id) {
    fetch('get_product.php?id=' + id)
        .then(response => response.text())
        .then(data => {
            document.getElementById('modalContent').innerHTML = data;
            document.getElementById('quickViewModal').style.display = 'block';
        });
}
function closeModal() {
    document.getElementById('quickViewModal').style.display = 'none';
}
</script>

</body>
</html>