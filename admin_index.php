<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
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
            font-size: 26px;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            color: #004d40;
            margin-bottom: 30px;
        }

        .nav-buttons a {
            display: inline-block;
            margin: 10px;
            padding: 12px 24px;
            background-color: #00796b;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .nav-buttons a:hover {
            background-color: #005f56;
        }

        .logout-link {
            margin-top: 30px;
            display: inline-block;
            font-size: 14px;
            color: #00796b;
            text-decoration: underline;
        }

        .logout-link:hover {
            color: #004d40;
        }
    </style>
</head>
<body>

    <div class="header">Admin Dashboard</div>

    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
        <div class="nav-buttons">
            <a href="admin_add.php">Add Product</a>
            <a href="admin_edit.php">Edit Product</a>
            <a href="admin_delete.php">Delete Product</a>
        </div>

        <a class="logout-link" href="logout.php">Logout</a>
    </div>

</body>
</html>