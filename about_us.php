<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us | Bloom & Branch</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; color: #333; line-height: 1.8; }
        
        /* Navbar */
        nav { background: #fff; padding: 20px 8%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .logo { font-size: 26px; font-weight: bold; color: #27ae60; }
        .nav-links { display: flex; gap: 25px; }
        .nav-links a { text-decoration: none; color: #333; font-weight: 600; }
        .nav-links a:hover { color: #27ae60; }

        /* About Section */
        .about-hero { background: #27ae60; color: white; padding: 60px 8%; text-align: center; }
        .container { padding: 50px 8%; max-width: 900px; margin: auto; background: white; border-radius: 10px; margin-top: -30px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        h2 { color: #27ae60; margin-bottom: 15px; }
        p { margin-bottom: 20px; font-size: 18px; color: #555; }
        .feature-list { list-style: none; margin-top: 20px; }
        .feature-list li { margin-bottom: 10px; padding-left: 25px; position: relative; }
        .feature-list li::before { content: "✓"; position: absolute; left: 0; color: #27ae60; font-weight: bold; }
    </style>
</head>
<body>

<nav>
    <div class="logo">Bloom & Branch</div>
    <div class="nav-links">
        <a href="index.php">Home🏠</a>
        <a href="shop.php">Shop🌿</a>
        <a href="about_us.php">About Usℹ️</a>
        <a href="contact.php">Contact Us✉️</a>
    </div>
</nav>

<div class="about-hero">
    <h1>About Our Passion for Plants</h1>
</div>

<div class="container">
    <h2>Our Story</h2>
    <p>Welcome to <strong>Bloom & Branch</strong>, your premier online destination for high-quality indoor and outdoor plants. Founded with a vision to bring the healing power of nature into every home, we believe that a greener space leads to a happier life.</p>
    
    <h2>Our Mission</h2>
    <p>Our mission is to simplify plant care for everyone. Whether you are a seasoned plant enthusiast or a beginner looking for your first green companion, we are here to provide healthy, vibrant plants and the expert guidance you need to help them thrive.</p>
    
    <h2>Why Choose Bloom & Branch?</h2>
    <ul class="feature-list">
        <li><strong>Premium Quality:</strong> We source only the healthiest plants from trusted growers.</li>
        <li><strong>Expert Support:</strong> Detailed care guides and tips provided with every purchase.</li>
        <li><strong>Sustainable Practices:</strong> We prioritize eco-friendly packaging and sustainable sourcing.</li>
        <li><strong>Convenient Delivery:</strong> Safe and swift delivery of your favorite plants right to your doorstep.</li>
    </ul>
    
    <p>Thank you for choosing to grow with us. Let's make the world a little greener, one plant at a time!</p>
</div>

</body>
</html>