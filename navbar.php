<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<style>
/* Navbar Styling */
.navbar {
    background-color: #00796b;
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.navbar-logo a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 24px;
}

.navbar-links {
    display: flex;  
    align-items: center;
    flex-wrap: nowrap ;
}

.navbar-links a {
    color: white;
    margin-left: 15px;
    text-decoration: none;
    font-size: 16px;
    transition: color 0.3s ease;
}

.navbar-links a:hover {
    color: #e0f7fa;
}

.navbar-links span {
    font-size: 16px;
    margin-right: 10px;
}

body {
    margin: 0;
    padding: 0;
}
</style>

<div class="navbar" style="background-color: #00796b; color: white; padding: 15px; display: flex; justify-content: space-between; align-items: center;">

    <div>
        <?php if (isset($_SESSION['admin'])): ?>
            <span>Welcome, <?= htmlspecialchars($_SESSION['admin']); ?> | </span>
            <a href="admin_index.php" style="color: white; margin-right: 15px;">Dashboard</a>
            <a href="logout.php" style="color: white;">Logout</a>

        <?php elseif (isset($_SESSION['user'])): ?>
            <span>Welcome, <?= htmlspecialchars($_SESSION['user']); ?> | </span>
            <a href="cart.php" style="color: white; margin-right: 15px;">My Cart</a>
            <a href="logout.php" style="color: white;">Logout</a>

        <?php else: ?>
            <a href="login.php" style="color: white; margin-right: 15px;">User Login</a>
            <a href="login.php" style="color: white;">Admin Login</a>
        <?php endif; ?>
    </div>
</div>
