<?php 
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db'); 
$message = "";

if(isset($_POST['register'])){
    $name = $_POST['name']; 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password === $confirm_password) {
        
        $sql = "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$password')";
        
        if($conn->query($sql) === TRUE){ 
            $message = "success"; 
        } else {
            $message = "Database Error: " . $conn->error;
        }
    } else {
        $message = "Passwords do not match!";
    }
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <title>Register | Bloom & Branch</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .reg-container { display: flex; background: white; width: 900px; border-radius: 20px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
        .img-side { flex: 1; background: url('https://images.unsplash.com/photo-1463936575829-25148e1db1b8?auto=format&fit=crop&w=500&q=80') center/cover; }
        .form-side { flex: 1; padding: 40px; }
        .logo { font-size: 24px; font-weight: bold; color: #27ae60; margin-bottom: 20px; }
        h2 { color: #1a2f24; margin-bottom: 5px; }
        input { width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #27ae60; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; margin-top: 15px; }
        .success-box { text-align: center; padding: 50px 20px; }
        .success-icon { font-size: 60px; color: #27ae60; margin-bottom: 15px; }
        .error-msg { color: red; text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="reg-container">
    <div class="img-side"></div>
    <div class="form-side">
        <?php if($message == "success"): ?>
            <div class="success-box">
                <div class="success-icon">✅</div>
                <h2>Registration Successful!</h2>
                <p>Welcome to Bloom & Branch. Your account is ready.</p>
                <a href="login.php" style="display:inline-block; margin-top:20px; color:#27ae60; font-weight:bold; text-decoration:none;">Login Here →</a>
            </div>
        <?php else: ?>
            <div class="logo">Bloom & Branch</div>
            <h2>Create Account</h2>
            <?php if($message != "" && $message != "success"): ?><p class="error-msg"><?php echo $message; ?></p><?php endif; ?>
            <form method="POST">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit" name="register">Register Now</button>
            </form>
            <p style="margin-top:15px; font-size: 14px;">Already have an account? <a href="login.php" style="color:#27ae60; font-weight:bold;">Login here</a></p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>