<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'db_connect.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);
        $s3Key = "product_images/" . time() . "_" . preg_replace('/[^a-zA-Z0-9._-]/', '_', $fileName);
        $bucketName = "graduationstore-bucket"; 

        // Run AWS CLI command to upload image
        $command = escapeshellcmd("aws s3 cp $fileTmpPath s3://$bucketName/$s3Key --acl public-read 2>&1");
        $output = shell_exec($command);

        // Check if upload appears successful
        if (strpos($output, 'upload:') !== false) {
            $imageUrl = "https://$bucketName.s3.amazonaws.com/$s3Key";

            // Save product to database
            $stmt = $conn->prepare("INSERT INTO products (name, price, description, image_url) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sdss", $name, $price, $desc, $imageUrl);

            if ($stmt->execute()) {
                $message = "Product added successfully!";
            } else {
                $message = "Database Error: " . $stmt->error;
            }
        } else {
            $message = "S3 Upload Error: " . htmlspecialchars($output);
        }
    } else {
        $message = "Please upload a valid image.";
    }
}
?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
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
            max-width: 600px;
            background-color: white;
            margin: 40px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #00796b;
            color: white;
            border: none;
            margin-top: 20px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #005f56;
        }

        .message {
            margin-top: 20px;
            color: green;
        }

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #00796b;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">Add Product</div>
    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Price (RM):</label>
            <input type="number" name="price" step="0.01" required>

            <label>Description:</label>
            <textarea name="description" required></textarea>

            <label>Product Image:</label>
            <input type="file" name="image" accept="image/*" required>

            <input type="submit" value="Add">
        </form>
        <p class="message"><?php echo $message; ?></p>
        <a href="admin_index.php">Back to Dashboard</a>
    </div>
</body>
</html>