<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');

if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
$cart_items = $conn->query("SELECT * FROM cart WHERE user_email='$user'");
$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout | Bloom & Branch</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; padding: 20px; }
        .main-wrapper { max-width: 1000px; margin: auto; display: flex; gap: 20px; }
        .col { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .col-1 { flex: 1; }
        .col-2 { flex: 0.8; }
        h1 { text-align: center; color: #1a2f24; margin-bottom: 30px; }
        h3 { color: #27ae60; margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        input, textarea, select { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        .btn-order { width: 100%; padding: 15px; background: #27ae60; color: white; border: none; border-radius: 8px; font-size: 18px; cursor: pointer; font-weight: bold; }
        .cart-list { list-style: none; padding: 0; }
        .cart-list li { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .total-price { font-size: 20px; font-weight: bold; color: #2c3e50; text-align: right; margin-top: 15px; }
    </style>
</head>
<body>

<h1>Checkout</h1>

<form action="order_success.php" method="POST">
    <div class="main-wrapper">
        <div class="col col-1">
            <h3>Shipping Details</h3>
            <input type="text" name="name" placeholder="Full Name" required>
            <textarea name="address" placeholder="Shipping Address" rows="4" required></textarea>
            <input type="text" name="phone" placeholder="Phone Number" required>
        </div>

        <div class="col col-2">
            <h3>Payment Method</h3>
            <select name="payment_method" required>
                <option value="Cash on Delivery">Cash on Delivery</option>
                <option value="Card Payment">Card Payment (Online)</option>
            </select>

            <h3>Order Summary</h3>
            <ul class="cart-list">
                <?php while($row = $cart_items->fetch_assoc()): ?>
                    <li>
                        <span><?php echo $row['product_name']; ?></span>
                        <span>Rs. <?php echo $row['price'] * $row['quantity']; ?></span>
                    </li>
                    <?php $total += ($row['price'] * $row['quantity']); ?>
                <?php endwhile; ?>
            </ul>
            <hr>
            <div class="total-price">Total: Rs. <?php echo $total; ?></div>
            
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            
            <button type="submit" name="confirm_order" class="btn-order">Place Order</button>
        </div>
    </div>
</form>

</body>
</html>