<?php
session_start();
include 'db_connect.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->fetch_assoc()) {
            $message = "Username already exists.";
        } else {
            // Insert into users table without hashing password
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password); // ← no hashing here
            if ($stmt->execute()) {
                $_SESSION['user'] = $username;
                header("Location: login.php");
                exit;
            } else {
                $message = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            background: linear-gradient(135deg, #00bcd4, #009688);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
            overflow: hidden;
            position: relative;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            animation: float 12s ease-in-out infinite;
        }

        .circle.one {
            width: 200px;
            height: 200px;
            top: 20%;
            left: 10%;
            animation-duration: 14s;
        }

        .circle.two {
            width: 150px;
            height: 150px;
            top: 50%;
            left: 80%;
            animation-duration: 18s;
        }

        .circle.three {
            width: 100px;
            height: 100px;
            top: 80%;
            left: 60%;
            animation-duration: 10s;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-30px) rotate(180deg);
            }
            100% {
                transform: translateY(0) rotate(360deg);
            }
        }

        .container {
            width: 100%;
            max-width: 400px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 1s ease-in-out;
            position: relative;
            z-index: 1;
        }

        h2 {
            font-size: 28px;
            color: #00796b;
            margin-bottom: 30px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #009688;
            outline: none;
        }

        input[type="submit"] {
            background-color: #009688;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #00796b;
        }

        .error {
            color: #d32f2f;
            margin-top: 10px;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #ffffff;
        }

        .footer a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<!-- Floating circles -->
<div class="circle one"></div>
<div class="circle two"></div>
<div class="circle three"></div>

<div class="container">
    <h2>Register</h2>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <input type="submit" value="Register">
    </form>

    <?php if ($message) { ?>
        <p class="error"><?php echo $message; ?></p>
    <?php } ?>

<div class="footer">
    <p>Already have an account?</p>
    <form action="login.php" method="get">
        <input type="submit" value="Go to Login">
    </form>
</div>

</div>

</body>
</html>
