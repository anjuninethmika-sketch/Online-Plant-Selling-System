<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');

if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];


if(isset($_POST['confirm_order'])) {
    $_SESSION['last_order'] = [
        'address' => $_POST['address'],
        'payment' => $_POST['payment_method'],
        'total'   => $_POST['total'],
        'order_id' => "#GS" . rand(1000, 9999)
    ];

    
    $cart_items = $conn->query("SELECT * FROM cart WHERE user_email='$user'");
    if ($cart_items->num_rows > 0) {
        $order_id_code = $_SESSION['last_order']['order_id'];
        
        while($row = $cart_items->fetch_assoc()) {
            $p_name = $row['product_name'];
            $price = $row['price'];
            $address = $_POST['address'];
            $pay_method = $_POST['payment_method'];
            
            
            $conn->query("INSERT INTO orders (user_email, product_name, price, payment_method, status, order_id, address) 
                          VALUES ('$user', '$p_name', '$price', '$pay_method', 'Pending', '$order_id_code', '$address')");
            
            
            $last_id = $conn->insert_id;
            
            
            $conn->query("INSERT INTO order_tracking (order_id, status) VALUES ($last_id, 'Pending')");
        }
        $conn->query("DELETE FROM cart WHERE user_email='$user'");
    }
}


$order_data = $_SESSION['last_order'] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation | Bloom & Branch</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; padding: 40px; }
        .success-container { max-width: 900px; margin: auto; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); display: flex; gap: 40px; }
        .left-side { flex: 1.5; text-align: center; }
        .right-side { flex: 1; border-left: 1px solid #eee; padding-left: 20px; }
        h1 { color: #1a2f24; margin: 10px 0; }
        .checkmark { font-size: 50px; color: #27ae60; }
        .btn-shop { display: inline-block; margin-top: 20px; padding: 12px 30px; background: #27ae60; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; }
        .info-box { margin-top: 30px; text-align: left; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>

<div class="success-container">
    <div class="left-side">
        <div class="checkmark">✓</div>
        <h1>Thank You!</h1>
        <p>Your order has been placed successfully.</p>
        <p><strong>Order ID Code: <?php echo $order_data['order_id'] ?? 'N/A'; ?></strong></p>
        <a href="index.php" class="btn-shop">Continue Shopping</a>
        
        <div class="info-box">
            <p><strong>Delivery Address:</strong><br><?php echo htmlspecialchars($order_data['address'] ?? 'Not provided'); ?></p>
            <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order_data['payment'] ?? 'Not provided'); ?></p>
        </div>
    </div>

    <div class="right-side">
        <h3>Order Summary</h3>
        <p>Total Amount: <strong>Rs. <?php echo number_format($order_data['total'] ?? 0, 2); ?></strong></p>
    </div>
</div>

</body>
</html>