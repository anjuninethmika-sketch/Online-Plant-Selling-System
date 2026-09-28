<?php 
session_start(); 
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db'); 
$error = "";

if(isset($_POST['login'])){
    $email = $_POST['email']; 
    $password = $_POST['password']; 
    
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
        $user_data = $result->fetch_assoc();
        $_SESSION['user'] = $user_data['email']; 
        $_SESSION['role'] = $user_data['role']; 
        $_SESSION['user_name'] = $user_data['username']; 

        if($user_data['role'] == 'admin') {
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }
        exit(); 
    } else { 
        $error = "Invalid Email or Password!"; 
    }
}
?>
<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <title>Login | Bloom & Branch</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; height: 100vh; display: flex; justify-content: center; align-items: center; margin: 0; }
        .login-container { display: flex; background: white; width: 850px; border-radius: 20px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
        .img-side { flex: 1; background: url('images/login.jpg') center/cover no-repeat; background-color: #e8f5e9; }
        .form-side { flex: 1; padding: 50px; display: flex; flex-direction: column; justify-content: center; }
        .logo { font-size: 24px; font-weight: bold; color: #27ae60; margin-bottom: 20px; text-align: center; }
        input { width: 100%; padding: 14px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 14px; background: #27ae60; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; margin-top: 15px; }
        .error { color: #d32f2f; background: #ffebee; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; }
        .footer-link { margin-top: 20px; font-size: 14px; color: #666; text-align: center; }
    </style>
</head>
<body>
<div class="login-container">
    <div class="form-side">
        <div class="logo">Bloom & Branch</div>
        <h2>Welcome Back!</h2>
        <?php if($error != ""): ?><div class="error"><?php echo $error; ?></div><?php endif; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <div class="footer-link">Don't have an account? <a href="register.php">Register here</a></div>
    </div>
    <div class="img-side"></div>
</div>
</body>
</html>