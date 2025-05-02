<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Graduation Gift Shop</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #def8fc;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #00796b;
            color: white;
            padding: 20px 0;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .hero {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            background-color: #e0f7fa;
            padding: 50px 20px;
            text-align: center;
        }

        .hero-text {
            max-width: 500px;
            margin: 20px;
        }

        .hero-text h1 {
            font-size: 32px;
            color: #004d40;
        }

        .hero-text p {
            font-size: 18px;
            line-height: 1.6;
            margin-top: 10px;
            color: #333;
        }

        .cta-button {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 30px;
            background-color: #00796b;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            background-color: #005f56;
        }

        .hero-image {
            max-width: 400px;
            margin: 20px;
        }

        .hero-image img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .features {
            background-color: #ffffff;
            padding: 40px 20px;
            text-align: center;
        }

        .features h2 {
            color: #00796b;
            margin-bottom: 30px;
        }

        .feature-box {
            display: inline-block;
            width: 200px;
            margin: 15px;
            padding: 20px;
            background-color: #f1fefe;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .feature-box i {
            font-size: 40px;
            color: #009688;
            margin-bottom: 10px;
        }

        .feature-box p {
            font-size: 14px;
            color: #333;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="header">Graduation Gift Shop</div>

    <div class="hero">
        <div class="hero-text">
            <h1>Celebrate Your Big Day with Meaningful Gifts!</h1>
            <p>
                Discover the perfect way to honor your graduation milestone with our exclusive collection of graduation gifts.
                From fresh bouquets and cuddly teddy bears to elegant gift boxes, we have something for every graduate.
            </p>
            <a href="items.php" class="cta-button">Browse Our Products</a>
        </div>
        <div class="hero-image">
            <img src="https://cdn.pixabay.com/photo/2020/01/13/08/50/flowers-4760928_960_720.jpg" alt="Graduation Gifts">
        </div>
    </div>

    <div class="features">
        <h2>Why Shop With Us?</h2>
        <div class="feature-box">
            <i class="fas fa-gift"></i>
            <p>Thoughtful, curated gifts</p>
        </div>
        <div class="feature-box">
            <i class="fas fa-tags"></i>
            <p>Affordable prices</p>
        </div>
        <div class="feature-box">
            <i class="fas fa-truck"></i>
            <p>Fast local delivery</p>
        </div>
        <div class="feature-box">
            <i class="fas fa-hand-holding-heart"></i>
            <p>Perfect for loved ones</p>
        </div>
    </div>
</body>
</html>