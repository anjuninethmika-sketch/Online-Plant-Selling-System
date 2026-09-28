<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');

if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];


$orders = $conn->query("SELECT order_id, SUM(price * IFNULL(quantity, 1)) as total_amount, status, order_date 
                        FROM orders 
                        WHERE user_email='$user' 
                        GROUP BY order_id 
                        ORDER BY order_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Order History | Bloom & Branch</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; padding: 40px; background: #f9f9f9; }
        .container { max-width: 900px; margin: auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #1a2f24; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #1a2f24; color: white; padding: 15px; }
        td { padding: 15px; border-bottom: 1px solid #ddd; text-align: center; }
        .status-pill { padding: 8px 15px; border-radius: 20px; font-size: 13px; background: #e8f5e9; color: #27ae60; text-decoration: none; font-weight: bold; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #1a2f24; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Order History</h1>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Total Amount</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <?php 
            if($orders->num_rows > 0) {
                while($row = $orders->fetch_assoc()): ?>
                <tr>
                    <td><strong><?php echo $row['order_id']; ?></strong></td>
                    <td>Rs. <?php echo number_format($row['total_amount'], 2); ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td>
                        <a href="track.php?id=<?php echo $row['order_id']; ?>" class="status-pill">
                            <?php echo $row['status']; ?> (Track)
                        </a>
                    </td>
                </tr>
                <?php endwhile; 
            } else {
                echo "<tr><td colspan='4'>No orders found yet.</td></tr>";
            }
            ?>
        </table>
        <a href="index.php" class="back-link">&larr; Back to Shop</a>
    </div>
</body>
</html>