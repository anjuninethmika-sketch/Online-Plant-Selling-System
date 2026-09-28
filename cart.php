<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');

$is_logged_in = isset($_SESSION['user']);

// 1. Add to Cart Logic
if(isset($_GET['add']) && $is_logged_in) {
    $product_id = $_GET['add'];
    $user_email = $_SESSION['user'];

    
    $check = $conn->query("SELECT * FROM cart WHERE user_email='$user_email' AND product_id='$product_id'");
    
    if($check->num_rows > 0) {
        $conn->query("UPDATE cart SET quantity = quantity + 1 WHERE user_email='$user_email' AND product_id='$product_id'");
    } else {
        
        $conn->query("INSERT INTO cart (user_email, product_id, product_name, price, quantity) 
                      SELECT '$user_email', id, name, price, 1 FROM products WHERE id = $product_id");
    }
    header("Location: cart.php");
    exit();
}


$cart_items = null;
if($is_logged_in) {
    $user = $_SESSION['user'];
    $cart_items = $conn->query("SELECT * FROM cart WHERE user_email='$user'");
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <title>Your Cart | Bloom & Branch</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; padding: 40px; }
        .cart-container { max-width: 900px; margin: auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        h1 { color: #1a2f24; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th { background: #f8f8f8; padding: 15px; text-align: left; border-bottom: 2px solid #ddd; }
        td { padding: 20px 15px; border-bottom: 1px solid #eee; }
        .qty-box { display: flex; align-items: center; gap: 10px; }
        .qty-btn { padding: 5px 10px; background: #eee; text-decoration: none; border-radius: 5px; color: #333; font-weight: bold; }
        .btn-green { background: #27ae60; color: white; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: bold; }
        .btn-light { background: #fff; color: #333; padding: 10px 20px; text-decoration: none; border: 1px solid #ddd; border-radius: 8px; }
        .summary-box { text-align: right; margin-top: 20px; }
    </style>
</head>
<body>

<div class="cart-container">
    <h1>Your Cart</h1>

    <?php if(!$is_logged_in): ?>
        <p>Please login to view your cart.</p>
        <a href="login.php" class="btn-green">Login here</a>
    <?php elseif($cart_items->num_rows == 0): ?>
        <p>Your cart is empty!</p>
        <a href="index.php" class="btn-green">Continue Shopping</a>
    <?php else: ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php 
            $subtotal = 0;
            while($row = $cart_items->fetch_assoc()): 
                $line_total = $row['price'] * $row['quantity'];
                $subtotal += $line_total;
            ?>
                <tr>
                    <td><?php echo $row['product_name']; ?></td>
                    <td>Rs. <?php echo $row['price']; ?></td>
                    <td>
                        <div class="qty-box">
                            <a href="update_cart.php?id=<?php echo $row['id']; ?>&action=minus" class="qty-btn">-</a>
                            <span><?php echo $row['quantity']; ?></span>
                            <a href="update_cart.php?id=<?php echo $row['id']; ?>&action=plus" class="qty-btn">+</a>
                        </div>
                    </td>
                    <td>Rs. <?php echo $line_total; ?></td>
                    <td><a href="update_cart.php?id=<?php echo $row['id']; ?>&action=remove" style="color: red; text-decoration: none;">✕</a></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <div class="summary-box">
            <p>Subtotal: <strong>Rs. <?php echo $subtotal; ?></strong></p>
            <p>Delivery: <strong>Rs. 300</strong></p>
            <h3>Total: Rs. <?php echo $subtotal + 300; ?></h3>
            <br>
            <a href="index.php" class="btn-light">Continue Shopping</a>
            <a href="checkout.php" class="btn-green">Proceed to Checkout</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>