<?php
session_start();
$conn = new mysqli("localhost", "root", "", "graduation_store");

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    header("Location: cart.php");
    exit;
}
?>
<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $product['name']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #00796b;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 28px;
        }
        .container {
            background-color: #ffffff;
            width: 90%;
            max-width: 700px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }
        h2 {
            margin: 20px 0 10px;
            color: #00796b;
        }
        p {
            color: #555;
        }
        form button {
            background-color: #009688;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 15px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #00796b;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #004d40;
            text-decoration: none;
        }
    </style>
</head>
<body>
<header>Product Details</header>
<div class="container">
    <form method="post">
    <h2><?php echo $product['name']; ?></h2>
    <p>Price: RM<?php echo number_format($product['price'], 2); ?></p>
    <p>Description:<br><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
    
    <form method="post">
        <button type="submit">Add to Cart</button>
    </form>
    <a href="items.php">← Back to Shop</a>

</div>
</body>
</html>