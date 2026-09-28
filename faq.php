<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FAQ | Bloom & Branch</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4fcf4; padding: 20px; }
        .wrapper { display: flex; max-width: 1000px; margin: auto; gap: 30px; }
        .main-content { flex: 3; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        
        /* Accordion Style */
        .faq-item { margin-bottom: 10px; border: 1px solid #e8f5e9; border-radius: 8px; overflow: hidden; }
        .question { width: 100%; text-align: left; padding: 15px; background: #e8f5e9; border: none; font-size: 1.1em; font-weight: bold; cursor: pointer; color: #1b5e20; }
        .answer { padding: 15px; display: none; background: #fff; color: #555; line-height: 1.6; }
        
        /* Sidebar */
        .sidebar { flex: 1; background: #fff; padding: 20px; border-radius: 12px; height: fit-content; border: 1px solid #e8f5e9; }
        .sidebar a { display: block; padding: 10px; color: #333; text-decoration: none; border-bottom: 1px solid #eee; }
        .sidebar a:hover { color: #2e7d32; font-weight: bold; }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="main-content">
        <h1 style="color:#2e7d32; text-align:center;">Frequently Asked Questions</h1>
        
        <div class="faq-item">
            <button class="question" onclick="toggle(this)">+ How long does it take for my order to be delivered?</button>
            <div class="answer">Once your order is confirmed, it typically takes 2 to 5 business days to be delivered to your address across the island.</div>
        </div>

        <div class="faq-item">
            <button class="question" onclick="toggle(this)">+ Can I return the products if they are damaged?</button>
            <div class="answer">Yes, if there is any damage to the plant upon delivery, please inform us within 24 hours with a photo, and we will arrange a replacement.</div>
        </div>

        <div class="faq-item">
            <button class="question" onclick="toggle(this)">+ What payment methods do you accept?</button>
            <div class="answer">We accept Cash on Delivery (COD) and direct online bank transfers.</div>
        </div>
        <div class="faq-item">
            <button class="question" onclick="toggle(this)">+ Do your plants come with pots?</button>
            <div class="answer">Yes, most of our plants come in standard plastic nursery pots. Decorative ceramic or hanging pots are available for purchase separately in our Shop.</div>
        </div>

        <div class="faq-item">
            <button class="question" onclick="toggle(this)">+ How do I know which plant is suitable for my home?</button>
            <div class="answer">You can check the description of each plant in our shop, or send us a photo of your space via WhatsApp, and we will recommend the best plants based on sunlight and humidity.</div>
        </div>

        <div class="faq-item">
            <button class="question" onclick="toggle(this)">+ Are these plants safe for pets?</button>
            <div class="answer">Some plants can be toxic to pets. Please check the product description where we mention if a plant is pet-friendly or keep them out of reach of your furry friends.</div>
        </div>

        <div class="faq-item">
            <button class="question" onclick="toggle(this)">+ Can I change or cancel my order?</button>
            <div class="answer">Yes, you can request a change or cancellation within 2 hours of placing the order by contacting us directly on WhatsApp.</div>
        </div>

        <div class="faq-item">
            <button class="question" onclick="toggle(this)">+ Do you have a physical store?</button>
            <div class="answer">Currently, we operate as an online-only store to keep our prices affordable, but we do participate in weekend plant exhibitions occasionally.</div>
        </div>

        <div class="faq-item">
            <button class="question" onclick="toggle(this)">+ How can I track my order?</button>
            <div class="answer">Once your order is dispatched, you will receive a WhatsApp message or email with the delivery status and rider details.</div>
        </div>

        <div class="faq-item">
            <button class="question" onclick="toggle(this)">+ Do you offer bulk discounts for events?</button>
            <div class="answer">Yes, we offer special rates for weddings, corporate events, and bulk purchases. Please reach out to us for a custom quote.</div>
        </div>

        <div class="faq-item">
            <button class="question" onclick="toggle(this)">+ What should I do if my plant starts looking unhealthy?</button>
            <div class="answer">Don't worry! Send us a photo of your plant, and our team will provide professional guidance on how to revive it.</div>
        </div>
    </div>

    <div class="sidebar">
        <h3>Quick Links</h3>
        <a href="index.php">🏠 Home</a>
        <a href="shop.php">🌿 Shop Plants</a>
        <a href="blog.php">📖 Blog</a>
        <a href="cart.php">🛒 My Cart</a>
    </div>
</div>

<script>
    function toggle(element) {
        let answer = element.nextElementSibling;
        answer.style.display = (answer.style.display === "block") ? "none" : "block";
    }
</script>

</body>
</html>