<?php
session_start();
include 'db_connect.php'; 


if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];


if(isset($_POST['update'])) {
    $new_status = $_POST['status'];
    

    $conn->begin_transaction();

    try {
        
        $stmt1 = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
        $stmt1->bind_param("si", $new_status, $id);
        $stmt1->execute();
        
        
        
        $stmt2 = $conn->prepare("INSERT INTO order_tracking (order_id, status) VALUES (?, ?)");
        $stmt2->bind_param("is", $id, $new_status);
        $stmt2->execute();

        $conn->commit(); 
        header("Location: admin_panel.php?success=1");
        exit();
    } catch (Exception $e) {
        $conn->rollback(); 
        echo "Error updating status: " . $e->getMessage();
    }
}


$stmt = $conn->prepare("SELECT * FROM orders WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
?>


<!DOCTYPE html>
<html>
<body>
    <h2>Update Order Status</h2>
    <form method="POST">
        <p>Current Status: <strong><?php echo htmlspecialchars($order['status']); ?></strong></p>
        <select name="status">
            <option value="Pending" <?php if($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Processing" <?php if($order['status'] == 'Processing') echo 'selected'; ?>>Processing</option>
            <option value="Completed" <?php if($order['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
            <option value="Cancelled" <?php if($order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
        </select>
        <button type="submit" name="update">Update Status</button>
    </form>
    <a href="admin_panel.php">Back to Dashboard</a>
</body>
</html>