<?php
// Database connection file එක link කරන්න
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gardening Tips | Bloom & Branch</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f4fcf4; margin: 0; padding: 20px; }
        .wrapper { display: flex; max-width: 1000px; margin: auto; gap: 30px; }
        
        /* Main Blog Area */
        .main-content { flex: 3; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        
        
        .post { margin-bottom: 50px; border-bottom: 2px solid #e8f5e9; padding-bottom: 30px; overflow: hidden; }
        
        
        .post img { 
            width: 200px; 
            height: 200px; 
            object-fit: cover; 
            border-radius: 10px; 
            float: left; 
            margin-right: 20px; 
            margin-bottom: 10px; 
        }
        
        .post h2 { color: #1b5e20; margin: 10px 0; }
        .meta { font-size: 0.85em; color: #777; margin-bottom: 10px; }
        .buy-btn { display: inline-block; background: #2e7d32; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 10px; font-weight: bold; }
        
        /* Sidebar */
        .sidebar { flex: 1; background: #fff; padding: 20px; border-radius: 12px; height: fit-content; border: 1px solid #e8f5e9; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .sidebar a { display: block; padding: 10px; color: #333; text-decoration: none; border-bottom: 1px solid #eee; }
        .sidebar a:hover { color: #2e7d32; font-weight: bold; }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="main-content">
        <h1>Gardening Tips & Guides</h1>

        <?php
        
        $sql = "SELECT * FROM blog_posts ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                echo "<div class='post'>";
                echo "<img src='images/" . $row['image_path'] . "' alt='Post Image'>";
                echo "<h2>" . $row['title'] . "</h2>";
                echo "<p class='meta'>" . $row['created_at'] . " | Category: Care Guides</p>";
                echo "<p>" . $row['content'] . "</p>";
                echo "<a href='shop.php' class='buy-btn'>View Details</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No blog posts available at the moment.</p>";
        }
        ?>
    </div>

    <div class="sidebar">
        <h3>Quick Links</h3>
        <a href="index.php">🏠 Home</a>
        <a href="shop.php">🌿 Shop Plants</a>
        <a href="faq.php">❓ FAQ Page</a>
        <a href="cart.php">🛒 My Cart</a>
    </div>
</div>

</body>
</html>