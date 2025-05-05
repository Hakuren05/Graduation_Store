<?php
$conn = new mysqli("graduationstore-project.c7m0qk1ncfgl.us-east-1.rds.amazonaws.com", "admin", "admin_1234", "graduation_store");
$result = $conn->query("SELECT * FROM products");
?>
<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Graduation Shop</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #00796b;
            color: white;
            padding: 25px 20px;
            text-align: center;
            font-size: 32px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .container {
            background-color: #ffffff;
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            overflow-x: auto;
            padding-bottom: 10px;
            justify-content: center;
        }

        .product {
            width: 220px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
        .product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 2px solid #f1f1f1;
        }
        .product h3 {
            font-size: 18px;
            color: #1e3d58;
            margin: 10px 0;
        }
        .product p {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
        }
        .product a {
            display: inline-block;
            background-color: #ff5c8d;
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 6px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
        .product a:hover {
            background-color: #d14b7a;
        }
        .back-button {
            display: inline-block;
            background-color: #00796b;
            color: white;
            padding: 14px 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #ff5c8d;
        }
    </style>
</head>
<body>
<header>Graduation Gift Shop</header>
   <a href="index.php" class="back-button">Back to Home</a>
<div class="container">
    <h2>Our Products</h2>
    <div class="product-grid">
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="product">
            <img src="<?php echo $row['image']; ?>" alt="Product Image">
            <h3><?php echo $row['name']; ?></h3>
            <p>RM<?php echo number_format($row['price'], 2); ?></p>
            <a href="product.php?id=<?php echo $row['id']; ?>">View Details</a>
        </div>
    <?php } ?>
</div>
    
</div>
</body>
</html>
