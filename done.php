<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['receipt'] = [
        'customer' => [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'payment_method' => $_POST['payment_method']
        ],
        'items' => $products,
        'quantities' => $cart,
        'total' => $total
    ];

    $_SESSION['cart'] = []; // Clear cart
    header("Location: done.php");
    exit;
}
?>

<?php
session_start();

$receipt = $_SESSION['receipt'] ?? null;

// Optionally clear the receipt session after showing
unset($_SESSION['receipt']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Complete</title>
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
            padding: 15px;
            text-align: center;
            font-size: 24px;
        }
        .container {
            background-color: #ffffff;
            width: 90%;
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        h2 {
            color: #27ae60;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 10px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #74b9ff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        a:hover {
            background-color: #4a90e2;
        }
    </style>
</head>
<body>
<header>Thank You!</header>
<div class="container">
    <h2>Your order has been placed successfully!</h2>

    <?php if ($receipt): ?>
        <h3>Receipt</h3>
        <p><strong>Name:</strong> <?= htmlspecialchars($receipt['customer']['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($receipt['customer']['email']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($receipt['customer']['phone']) ?></p>
        <p><strong>Address:</strong> <?= nl2br(htmlspecialchars($receipt['customer']['address'])) ?></p>
        <p><strong>Payment Method:</strong> <?= htmlspecialchars($receipt['customer']['payment_method']) ?></p>

        <table>
            <tr>
                <th>Product</th>
                <th>Price (RM)</th>
                <th>Quantity</th>
                <th>Subtotal (RM)</th>
            </tr>
            <?php foreach ($receipt['items'] as $id => $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= number_format($product['price'], 2) ?></td>
                    <td><?= $receipt['quantities'][$id] ?></td>
                    <td><?= number_format($product['price'] * $receipt['quantities'][$id], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <p class="total">Total Paid: RM<?= number_format($receipt['total'], 2) ?></p>
    <?php else: ?>
        <p>No receipt found. Please go back to the <a href="index.php">shop</a>.</p>
    <?php endif; ?>

    <a href="index.php">Back to Shop</a>
</div>
</body>
</html>
