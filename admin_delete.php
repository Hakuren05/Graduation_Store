<?php include 'navbar.php'; ?>
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Product</title>
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
            text-align: center;
            padding: 20px;
            font-size: 24px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            padding: 12px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        a.delete-link {
            background-color: #e53935;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        a.delete-link:hover {
            background-color: #c62828;
        }

        a.back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #00796b;
            text-decoration: underline;
        }
        
    </style>
</head>
<body>
    <div class="header">Delete Products</div>
    <div class="container">
        <?php
        // Ensure a valid database connection
        if ($conn) {
            // Fetch products from the database
            $result = $conn->query("SELECT * FROM products");

            // Check if the query was successful
            if ($result->num_rows > 0) {
                // Display products in a list
                echo '<ul>';
                while ($row = $result->fetch_assoc()) {
                    echo '<li>';
                    echo '<span>' . $row['name'] . ' - RM ' . number_format($row['price'], 2) . '</span>';
                    echo '<a class="delete-link" href="?delete=' . $row['id'] . '" onclick="return confirm(\'Are you sure?\')">Delete</a>';
                    echo '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>No products found.</p>';
            }
        } else {
            echo '<p>Failed to connect to the database.</p>';
        }

        // Delete product if "delete" parameter is present in the URL
        if (isset($_GET['delete'])) {
            $product_id = $_GET['delete'];

            // Prepare the DELETE query
            $delete_query = "DELETE FROM products WHERE id = ?";
            if ($stmt = $conn->prepare($delete_query)) {
                $stmt->bind_param("i", $product_id);
                if ($stmt->execute()) {
                    echo '<p>Product deleted successfully.</p>';
                    // Optionally redirect to avoid reloading the page with the delete query in the URL
                    header('Location: admin_delete.php');
                    exit();
                } else {
                    echo '<p>Error deleting product.</p>';
                }
            } else {
                echo '<p>Error preparing the delete query.</p>';
            }
        }
        ?>

        <a class="back-link" href="admin_index.php">Back to Dashboard</a>
    </div>
</body>
</html>