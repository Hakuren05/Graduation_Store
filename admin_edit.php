<?php include 'navbar.php'; ?>
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Products</title>
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
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        form {
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #00796b;
            color: white;
            border: none;
            margin-top: 15px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #005f56;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #00796b;
            text-decoration: underline;
        }
        
    </style>
</head>
<body>
    <div class="header">Edit Products</div>
    <div class="container">
        <?php
        // Ensure a valid database connection is established
        if ($conn) {
            // Fetch the products from the database
            $result = $conn->query("SELECT * FROM products");
            
            // Check if the query was successful
            if ($result->num_rows > 0) {
                // Loop through each product
                while ($row = $result->fetch_assoc()):
        ?>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">

                        <label>Name:</label>
                        <input type="text" name="name" value="<?= $row['name'] ?>">

                        <label>Price (RM):</label>
                        <input type="number" name="price" step="0.01" value="<?= $row['price'] ?>">

                        <label>Description:</label>
                        <textarea name="description"><?= $row['description'] ?></textarea>

                        <input type="submit" name="update" value="Update">
                    </form>
        <?php
                endwhile;
            } else {
                echo "<p>No products found.</p>";
            }
        } else {
            echo "<p>Failed to connect to the database.</p>";
        }
        ?>
        <a href="admin_index.php">Back to Dashboard</a>
    </div>
</body>
</html>