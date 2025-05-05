<?php
session_start();
$conn = new mysqli("localhost", "root", "", "graduation_store");

$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    header("Location: cart.php");
    exit;
}

$products = [];
$total = 0;

if (!empty($cart)) {
    $ids = implode(",", array_keys($cart));
    $query = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
    while ($row = $query->fetch_assoc()) {
        $products[$row['id']] = $row;
        $total += $row['price'] * $cart[$row['id']];
    }
}

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

    $_SESSION['cart'] = []; // Clear cart after checkout
    header("Location: done.php");
    exit;
}

?>
<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
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
        }
        form input, form select, form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        form button {
            background-color: #009688;
            color: white;
            padding: 14px 28px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #00796b;
        }
        .total {
            font-weight: bold;
            text-align: right;
            margin-bottom: 20px;
        }
        .cancel-btn {
            display: inline-block;
            padding: 14px 28px;
            background-color: #d32f2f;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            line-height: 20px;
        }
        .cancel-btn:hover {
            background-color: #b71c1c;
        }

        
    </style>
</head>
<body>
<header>Checkout</header>
<div class="container">
    <h2>Customer Information</h2>
    <form method="post">
<form method="post">
    <label>Full Name</label>
    <input type="text" name="name" required>

    <label>Email Address</label>
    <input type="email" name="email" required>

    <label>Phone Number</label>
    <input type="tel" name="phone" required>

    <label>Shipping Address</label>
    <textarea name="address" rows="4" required></textarea>

    <label>Payment Method</label>
    <select name="payment_method" id="payment_method" required onchange="showPaymentFields()">
        <option value="">-- Select --</option>
        <option value="COD">Cash on Delivery</option>
        <option value="OnlineBanking">Online Banking</option>
        <option value="Card">Debit/Credit Card</option>
    </select>

    <!-- Online Banking Details -->
    <div id="online_banking_fields" style="display: none;">
        <label>Bank Name</label>
        <input type="text" name="bank_name">

        <label>Account Holder Name</label>
        <input type="text" name="account_holder">
    </div>

    <!-- Card Payment Details -->
    <div id="card_fields" style="display: none;">
        <label>Card Number</label>
        <input type="text" name="card_number" pattern="\d{16}" maxlength="16" placeholder="1234 5678 9012 3456">

        <label>Card Holder Name</label>
        <input type="text" name="card_holder">

        <label>Expiry Date</label>
        <input type="month" name="expiry_date">

        <label>CVV</label>
        <input type="text" name="cvv" pattern="\d{3}" maxlength="3" placeholder="123">
    </div>

    <p class="total">Total: RM<?php echo number_format($total, 2); ?></p>

    <div style="display: flex; gap: 15px;">
        <button type="submit">Place Order</button>
        <a href="cart.php" class="cancel-btn">Cancel</a>
    </div>
</form>

<script>
function showPaymentFields() {
    const method = document.getElementById("payment_method").value;
    document.getElementById("online_banking_fields").style.display = (method === "OnlineBanking") ? "block" : "none";
    document.getElementById("card_fields").style.display = (method === "Card") ? "block" : "none";
}
</script>


</div>
</body>
</html>
