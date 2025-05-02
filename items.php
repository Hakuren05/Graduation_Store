<?php
$conn = new mysqli("localhost", "root", "", "graduation_store");
$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Graduation Shop</title>
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
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .product {
            display: inline-block;
            width: 45%;
            margin: 2%;
            background-color: #fafafa;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 1px 1px 8px rgba(0,0,0,0.08);
            text-align: center;
            vertical-align: top;
        }
        .product img {
            max-width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
        .product h3 {
            color: #00796b;
        }
        .product p {
            color: #333;
        }
        .product a {
            display: inline-block;
            margin-top: 10px;
            background-color: #009688;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 6px;
        }
        .product a:hover {
            background-color: #00796b;
        }
    </style>
</head>
<body>
<header>Graduation Gift Shop</header>
<div class="container">
    <h2>Our Products</h2>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="product">
            <img src="<?php echo $row['image']; ?>" alt="Product Image">
            <h3><?php echo $row['name']; ?></h3>
            <p>RM<?php echo number_format($row['price'], 2); ?></p>
            <a href="product.php?id=<?php echo $row['id']; ?>">View Details</a>
        </div>
    <?php } ?>
</div>
</body>
</html>