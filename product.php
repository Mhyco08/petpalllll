<?php
include 'db_config.php';

// Handle adding a product
if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image_path = "";

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_path = "uploads/" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }

    $sql = "INSERT INTO products (product_name, description, price, stock, image_path) VALUES (:product_name, :description, :price, :stock, :image_path)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':product_name' => $product_name,
        ':description' => $description,
        ':price' => $price,
        ':stock' => $stock,
        ':image_path' => $image_path
    ]);

    header("Location: product.php");
    exit;
}

// Handle updating a product
if (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image_path = $_POST['current_image'];

    // Handle image upload if new image is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_path = "uploads/" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }

    $sql = "UPDATE products SET product_name = :product_name, description = :description, price = :price, stock = :stock, image_path = :image_path WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':product_name' => $product_name,
        ':description' => $description,
        ':price' => $price,
        ':stock' => $stock,
        ':image_path' => $image_path
    ]);

    header("Location: product.php");
    exit;
}

// Handle deleting a product
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);

    header("Location: product.php");
    exit;
}

// Fetch all products
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        h1, h2 {
            text-align: center;
        }
        .add-product-form {
    background: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 20px auto;
}

.add-product-form h2 {
    text-align: center;
    color: #333;
}

.add-product-form .form-group {
    margin-bottom: 15px;
}

.add-product-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

.add-product-form input,
.add-product-form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.add-product-form input[type="file"] {
    padding: 5px;
    border: none;
}

.add-product-form button {
    background: #27ae60;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
}

.add-product-form button:hover {
    background: #219150;
}

        .product-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    position: relative; /* Ensures stacking context */
}
.product-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    position: relative;
    overflow: hidden; /* Prevent image overflow */
}

        .product-card h3 {
            margin: 0 0 10px;
        }
        .product-card p {
            margin: 5px 0;
            color: #555;
        }
        .product-card .price {
            color: #27ae60;
            font-weight: bold;
        }
        .product-card img {
        width: 100%;
        height: 200px; /* Set a fixed height */
        object-fit: cover; /* Ensures the image fills the area without distortion */
        border-radius: 4px;
        margin-bottom: 10px;
        }

        .product-card .actions {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
        .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Higher z-index to prevent stacking issues */
}
.modal-content {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 90%; /* Ensure modal fits smaller screens */
    max-width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
    z-index: 10000; /* Ensure content is above other elements */
}

        .modal.active {
            display: flex;
        }
        
        .modal-content h2 {
            margin-top: 0;
        }
        .modal-content input,
        .modal-content textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .modal-content button {
            background: #27ae60;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .modal-content .close-btn {
            background: #e74c3c;
            position: absolute;
            top: 10px;
            right: 10px;
            border: none;
            border-radius: 50%;
            color: #fff;
            width: 30px;
            height: 30px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Product Management</h1>
    <h2>Add New Product</h2>
    <form class="add-product-form" action="product.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" id="product_name" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" id="stock" min="0" required>
        </div>
        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit" name="add_product">Add Product</button>
    </form>


    <h2>All Products</h2>
    <div class="product-container">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                <img src="<?php echo $product['image_path'] ? $product['image_path'] : 'default.jpg'; ?>" alt="Product Image">
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="price">$<?php echo htmlspecialchars($product['price']); ?></p>
                <p>Stock: <?php echo htmlspecialchars($product['stock']); ?></p>
                <button class="actions" onclick="openModal(<?php echo $product['id']; ?>, '<?php echo htmlspecialchars($product['product_name']); ?>', '<?php echo htmlspecialchars($product['description']); ?>', <?php echo htmlspecialchars($product['price']); ?>, <?php echo htmlspecialchars($product['stock']); ?>, '<?php echo $product['image_path']; ?>')">⋮</button>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Floating Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal()">×</button>
            <h2>Update Product</h2>
            <form action="product.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="modal_id">
                <label for="modal_product_name">Product Name:</label>
                <input type="text" name="product_name" id="modal_product_name" required>
                <label for="modal_description">Description:</label>
                <textarea name="description" id="modal_description" rows="4" required></textarea>
                <label for="modal_price">Price:</label>
                <input type="number" name="price" id="modal_price" step="0.01" required>
                <label for="modal_stock">Stock:</label>
                <input type="number" name="stock" id="modal_stock" min="0" required>
                <label for="modal_image">Product Image:</label>
                <input type="file" name="image" id="modal_image">
                <input type="hidden" name="current_image" id="modal_current_image">
                <button type="submit" name="update_product">Update</button>
            </form>
            <br>
            <a href="#" id="delete_link"><button style="background: #e74c3c;">Delete</button></a>
        </div>
    </div>

    <script src="JS/script.js"></script>
        
</body>
</html>
