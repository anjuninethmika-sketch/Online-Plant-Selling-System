<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');

$show_search = true;
$id = 0;
$current_status = 'Pending';
$statuses = ['Pending', 'Processing', 'Shipped', 'Delivered'];
$current_index = 0;


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']); 
    
    
    $check_order = $conn->query("SELECT id FROM orders WHERE id = $id");
    
    if ($check_order->num_rows > 0) {
        $show_search = false;
        
        
        $current_order = $conn->query("SELECT status FROM order_tracking WHERE order_id = $id ORDER BY id DESC LIMIT 1")->fetch_assoc();
        $current_status = $current_order['status'] ?? 'Pending';
        $current_index = array_search($current_status, $statuses);
        
        
        if ($current_index === false) $current_index = 0;
    } else {
        $error_msg = "Order ID not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <title>Order Tracking</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; padding: 40px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; }
        h2 { color: #1a2f24; margin-bottom: 30px; }
        input[type="text"] { padding: 12px; width: 60%; border: 1px solid #ccc; border-radius: 5px; }
        button { padding: 12px 25px; background: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .progress-container { display: flex; justify-content: space-between; margin: 50px 0; position: relative; padding: 0 20px; }
        .progress-container::before { content: ""; position: absolute; top: 20px; left: 60px; right: 60px; height: 4px; background: #e0e0e0; z-index: 0; }
        .step { text-align: center; width: 25%; z-index: 1; position: relative; }
        .circle { width: 40px; height: 40px; background: #e0e0e0; border-radius: 50%; margin: auto; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-bottom: 10px; transition: 0.3s; }
        .circle.active { background: #27ae60; }
        .status-name { font-weight: bold; color: #333; margin: 5px 0; display: block; }
        .date { font-size: 11px; color: #777; display: block; }
        .back-link { display: inline-block; margin-top: 40px; color: #1a2f24; font-weight: bold; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($show_search): ?>
            <h2>Track Your Order</h2>
            <?php if(isset($error_msg)) echo "<p style='color:red;'>$error_msg</p>"; ?>
            <form action="track.php" method="GET">
                <input type="text" name="id" placeholder="Enter Order ID" required>
                <button type="submit">Track Order</button>
            </form>
        <?php else: ?>
            <h2>Order Tracking - #<?php echo $id; ?></h2>
            <div class="progress-container">
                <?php foreach($statuses as $index => $s): 
                    $date_res = $conn->query("SELECT updated_at FROM order_tracking WHERE order_id = $id AND status = '$s'");
                    $date_row = $date_res->fetch_assoc();
                    $date = $date_row['updated_at'] ?? null;
                ?>
                    <div class="step">
                        <div class="circle <?php echo ($index <= $current_index) ? 'active' : ''; ?>">✓</div>
                        <span class="status-name"><?php echo $s; ?></span>
                        <span class="date"><?php echo ($date) ? date('d M Y', strtotime($date)) : '--'; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <a href="index.php" class="back-link">← Back to Home</a>
    </div>
</body>
</html>