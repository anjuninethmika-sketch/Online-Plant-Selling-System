<?php 
session_start(); 
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db'); 
?>
<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <title>Bloom & Branch | Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background-color: #f9f9f9; }

        /* Navigation Bar */
        nav { background: #fff; padding: 20px 8%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .logo { font-size: 28px; font-weight: 800; color: #27ae60; }
        .nav-links { display: flex; gap: 25px; align-items: center; }
        .nav-links a { text-decoration: none; color: #555; font-weight: 600; font-size: 15px; transition: 0.3s; }
        .nav-links a:hover { color: #27ae60; }

        /* Hero Section */
        .hero-container {
            position: relative;
            width: 100%;
            height: 85vh;
            background-image: url('images/online.jpg'); 
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .hero-content {
            background: rgba(255, 255, 255, 0.4); 
            padding: 50px;
            border-radius: 15px;
        }
        
        
        .hero-content h1 { 
            font-size: 55px; 
            margin-bottom: 20px; 
            font-weight: 900;     
            color: #000000;     
            text-shadow: 1px 1px 2px rgba(255,255,255,0.8);
        }

        .hero-btn {
            background: #27ae60; color: white; padding: 15px 40px; 
            border-radius: 50px; text-decoration: none; font-weight: bold; font-size: 18px;
            display: inline-block; transition: 0.3s;
        }
        .hero-btn:hover { background: #219150; transform: scale(1.05); }

        /* Footer */
        footer { background: #1a2f24; color: #ccc; padding: 30px 8%; text-align: center; }
        .admin-link { color: #555; text-decoration: none; font-size: 12px; margin-top: 10px; display: block; }
    </style>
</head>
<body>

<nav>
    <div class="logo">Bloom & Branch</div>
    <div class="nav-links">
        <a href="index.php">🏠 Home</a>
        <a href="about_us.php">ℹ️ About Us</a>
        <a href="shop.php">🌿 Shop</a>
        <a href="cart.php">🛒 Cart</a>
        <a href="track.php">🚚 Track Order</a>
        <a href="contact.php">✉️ Contact Us</a>
        
        <?php if(isset($_SESSION['user_name'])): ?>
            <a href="profile.php" style="color: #27ae60; font-weight: bold;">👤 <?php echo htmlspecialchars($_SESSION['user_name']); ?></a>
            <a href="logout.php">🚪 Logout</a>
        <?php else: ?>
            <a href="register.php">📝 Register</a>
        <?php endif; ?>
    </div>
</nav>

<div class="hero-container">
    <div class="hero-content">
        <h1>Let's Bring the Spring to Your Home</h1>
        <a href="shop.php" class="hero-btn">Shop Now</a>
    </div>
</div>

<footer>
    <p>&copy; 2026 Bloom & Branch. All rights reserved.</p>
    <a href="admin.php" class="admin-link">Admin Dashboard</a>
</footer>

</body>
</html>