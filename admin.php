<?php 
session_start();
// ආරක්ෂාව සඳහා: Admin කෙනෙක් නෙවෙයි නම් login පේජ් එකට යවනවා
//if(!isset($_SESSION['admin_logged_in'])) {
    //header("Location: login.php");
    //exit();
//}

$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard | Bloom & Branch</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; display: flex; margin: 0; background: #f4f4f4; }
        .sidebar { width: 250px; background: #2e7d32; color: white; height: 100vh; padding: 20px; }
        .sidebar a { display: block; color: white; padding: 12px; text-decoration: none; border-bottom: 1px solid #45a049; }
        .main { flex: 1; padding: 30px; }
        .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #2e7d32; color: white; }
        .reply-btn { background: #25d366; color: white; padding: 6px 12px; border-radius: 5px; text-decoration: none; font-size: 13px; font-weight: bold; }
        .reply-btn:hover { background: #128c7e; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="admin.php">Dashboard</a>
    <a href="index.php">View Shop</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">
    
    <div class="card">
        <h2>Customer Messages</h2>
        <table>
            <tr><th>Name</th><th>Email</th><th>Phone</th><th>Subject</th><th>Message</th><th>Action</th></tr>
            <?php
            $msg_result = $conn->query("SELECT * FROM contact_messages ORDER BY id DESC");
            while($msg = $msg_result->fetch_assoc()){
                echo "<tr>
                    <td>{$msg['name']}</td>
                    <td>{$msg['email']}</td>
                    <td>{$msg['phone']}</td>
                    <td>{$msg['subject']}</td>
                    <td>{$msg['message']}</td>
                    <td>
                        <a href='https://wa.me/{$msg['phone']}?text=Hello%20{$msg['name']},%20I%20am%20from%20Bloom%20&%20Branch%20regarding%20your%20message:%20{$msg['subject']}' 
                           target='_blank' class='reply-btn'>WhatsApp Reply</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </div>

    <div class="card">
        <h2>Current Plants</h2>
        <table>
            <tr><th>ID</th><th>Name</th><th>Price</th></tr>
            <?php
            $result = $conn->query("SELECT * FROM products");
            while($row = $result->fetch_assoc()){
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>Rs. {$row['price']}</td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>