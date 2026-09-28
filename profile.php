<?php 
session_start();
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');


if(!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit(); 
}

$user = $_SESSION['user'];
$message = "";


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $phone = $conn->real_escape_string($_POST['phone']);

    
    $sql = "UPDATE users SET name='$name', address='$address', phone='$phone' WHERE email='$user'";
    
    if($conn->query($sql)) {
        $message = "Profile updated successfully!";
        $_SESSION['user_name'] = $name; 
    } else {
        $message = "Error updating profile: " . $conn->error;
    }
}


$result = $conn->query("SELECT * FROM users WHERE email='$user'");
$profile = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <title>My Profile | Bloom & Branch</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; padding: 50px; }
        .profile-box { max-width: 450px; margin: auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        h1 { color: #1a2f24; text-align: center; }
        input { width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        .readonly-input { background: #f9f9f9; }
        button { width: 100%; padding: 12px; background: #27ae60; color: white; border: none; border-radius: 8px; cursor: pointer; margin-top: 10px; }
    </style>
</head>
<body>
<div class="profile-box">
    <h1>My Profile</h1>
    <h2 style="text-align: center; color: #27ae60; font-size: 18px;">Hello, <?php echo htmlspecialchars($_SESSION['user_name'] ?? $profile['name'] ?? 'User'); ?>!</h2>
    
    <?php if($message != ""): ?>
        <p style="color:green; text-align:center;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Email:</label> 
        <input type="email" value="<?php echo htmlspecialchars($profile['email'] ?? ''); ?>" class="readonly-input" readonly>
        
        <label>Name:</label> 
        <input type="text" name="name" value="<?php echo htmlspecialchars($profile['name'] ?? ''); ?>" required>
        
        <label>Address:</label> 
        <input type="text" name="address" value="<?php echo htmlspecialchars($profile['address'] ?? ''); ?>" required>
        
        <label>Phone:</label> 
        <input type="text" name="phone" value="<?php echo htmlspecialchars($profile['phone'] ?? ''); ?>" required>
        
        <button type="submit">Update Profile</button>
    </form>
    
    <a href="index.php" style="display:block; text-align:center; margin-top:15px; color:#1a2f24;">← Back to Home</a>
</div>
</body>
</html>