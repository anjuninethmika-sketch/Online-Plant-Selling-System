<?php 
$conn = new mysqli('localhost', 'root', '', 'plant_shop_db');

if(isset($_POST['send'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO contact_messages (name, email, phone, subject, message) VALUES ('$name', '$email', '$phone', '$subject', '$message')";
    
    if($conn->query($sql)) {
        
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us | Bloom & Branch</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f0; padding: 20px; }
        .wrapper { max-width: 1000px; margin: auto; background: white; padding: 50px; border-radius: 25px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); }
        .logo { font-size: 40px; font-weight: bold; color: #2e7d32; text-align: center; margin-bottom: 30px; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; }
        .info-card { background: #fff; padding: 30px; border-radius: 20px; border: 1px solid #e0e0e0; transition: 0.4s; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .info-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,128,0,0.2); border-color: #2e7d32; }
        .map-box { margin-top: 30px; border-radius: 20px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        input, textarea { width: 100%; padding: 15px; margin: 10px 0; border: 2px solid #f0f0f0; border-radius: 12px; transition: 0.3s; }
        input:focus, textarea:focus { border-color: #2e7d32; outline: none; }
        button { width: 100%; padding: 16px; background: #2e7d32; color: white; border: none; border-radius: 12px; font-weight: bold; cursor: pointer; font-size: 16px; }
        @media (max-width: 768px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="logo">Bloom & Branch</div>

    <div class="grid">
        <div class="left">
            <div class="info-card">
                <h3><i class="fas fa-map-marker-alt" style="color:#2e7d32;"></i> Our Location</h3>
                <p>123, Green Road, Kalawana.</p>
                <br>
                <h3><i class="fas fa-phone-alt" style="color:#2e7d32;"></i> Call Us</h3>
                <p>+94 77 123 4567</p>
                <br>
                <h3><i class="fas fa-envelope" style="color:#2e7d32;"></i> Email Us</h3>
                <p>info@bloombranch.com</p>
            </div>

            <div class="map-box">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.472714523999!2d80.4496!3d6.6576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sKalawana!5e0!3m2!1sen!2slk!4v1612345678901!5m2!1sen!2slk" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <div class="right">
            <h2 style="margin-bottom:20px;">Send a Message</h2>
            <form method="POST">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="text" name="phone" placeholder="Phone Number" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea name="message" placeholder="Type your message here..." rows="6" required></textarea>
                <button type="submit" name="send">Send Message</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>