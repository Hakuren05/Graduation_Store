<?php
session_start();
$conn = new mysqli("localhost", "root", "", "graduation_store");

// Handle quantity update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    foreach ($_POST['quantities'] as $id => $qty) {
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
    }
    header("Location: cart.php");
    exit;
}

// Handle remove
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove'])) {
    $id = $_POST['id'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}

$cart = $_SESSION['cart'] ?? [];
$products = [];

if (!empty($cart)) {
    $ids = implode(",", array_keys($cart));
    $query = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
    while ($row = $query->fetch_assoc()) {
        $products[$row['id']] = $row;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
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
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #b2dfdb;
        }
        input[type="number"] {
            width: 60px;
            padding: 5px;
        }
        button {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .update-btn {
            background-color: #009688;
            color: white;
        }
        .update-btn:hover {
            background-color: #004d40;
        }
        .remove-btn {
            background-color: #d32f2f;
            color: white;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 15px;
        }
        .checkout-link {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #009688;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
        .checkout-link:hover {
            background-color: #004d40;
        }
        .continue-btn {
            display: inline-block;
            margin-top: 10px;
            margin-left: 10px;
            padding: 10px 22px;
            background-color: #4db6ac;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
        .continue-btn:hover {
            background-color: #00796b;
        }

    </style>
</head>
<body>
<header>Your Cart</header>
<div class="container">
    <?php if (empty($cart)) { ?>
        <p>Your cart is empty.</p>
        <a href="index.php" class="checkout-link">← Back to Shop</a>
    <?php } else { ?>
        <form method="post">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php
                $total = 0;
                foreach ($cart as $id => $qty):
                    $product = $products[$id];
                    $subtotal = $product['price'] * $qty;
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td>
                        <input type="number" name="quantities[<?php echo $id; ?>]" value="<?php echo $qty; ?>" min="0">
                    </td>
                    <td>RM<?php echo number_format($subtotal, 2); ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button type="submit" name="remove" class="remove-btn">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <button type="submit" name="update" class="update-btn">Update Cart</button>
        </form>
        <p class="total">Total: RM<?php echo number_format($total, 2); ?></p>
        <a href="checkout.php" class="checkout-link">Proceed to Checkout</a>
        <a href="index.php" class="continue-btn">← Continue Shopping</a>
    <?php } ?>
</div>
</body>
</html>