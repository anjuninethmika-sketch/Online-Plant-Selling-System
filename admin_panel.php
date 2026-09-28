<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');


if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if(isset($_POST['add_product'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $image);
    $conn->query("INSERT INTO products (name, price, category, image_url) VALUES ('$name', '$price', '$category', '$image')");
}


if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id=$id");
}

$products = $conn->query("SELECT * FROM products");
$orders = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel | Bloom & Branch</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; padding: 20px; }
        .box { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        h2 { color: #1a2f24; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background: #f8f8f8; }
        .btn-delete { color: #e74c3c; text-decoration: none; }
        .btn-update { color: #27ae60; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <div class="box">
        <h2>Add New Plant</h2>
        <form method="POST" enctype="multipart/form-data" style="display: flex; gap: 10px;">
            <input type="text" name="name" placeholder="Plant Name" required>
            <input type="number" name="price" placeholder="Price" required>
            <select name="category"><option value="indoor">Indoor</option><option value="outdoor">Outdoor</option></select>
            <input type="file" name="image" required>
            <button type="submit" name="add_product">Add Product</button>
        </form>
    </div>

    <div class="box">
        <h2>Manage Orders</h2>
        <table>
            <tr><th>Email</th><th>Product</th><th>Status</th><th>Action</th></tr>
            <?php while($row = $orders->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['user_email']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><a href="update_order.php?id=<?php echo $row['id']; ?>" class="btn-update">Change Status</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="box">
        <h2>Manage Products</h2>
        <table>
            <tr><th>Name</th><th>Price</th><th>Action</th></tr>
            <?php while($row = $products->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td>Rs. <?php echo $row['price']; ?></td>
                <td><a href="admin_panel.php?delete=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    </div> 

    <div class="box">
        <h2>Customer Messages</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
            </tr>
            <?php 
            $msgs = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
            while($m = $msgs->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $m['name']; ?></td>
                    <td><?php echo $m['email']; ?></td>
                    <td><?php echo $m['message']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

</body>
</html>

</body>
</html>