<nav>
    <div class="logo">GreenShop</div>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="shop.php">Shop</a>
        <a href="cart.php">My Cart</a>
        <?php if(isset($_SESSION['user'])): ?>
            <a href="order_history.php">My Orders</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>
</nav>