<?php
include("connection.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $cat_id = $_POST['cat_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if ($_FILES['img']['error'] === 0) {
        $imgName = basename($_FILES['img']['name']);
        $tmp_name = $_FILES['img']['tmp_name'];

        // Save in projectETEC/image/products/
        $targetDir = "../../image/products/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . $imgName;

        if (move_uploaded_file($tmp_name, $targetFile)) {
            // Save relative path to DB
            $imgPath = "image/products/" . $imgName;

            $sql = "INSERT INTO products (pro_name, cat_id, price, description, img) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sidss", $name, $cat_id, $price, $description, $imgPath);

            if ($stmt->execute()) {
                echo "<script>alert('Product Inserted Successfully!'); window.location.href='../product.php';</script>";
            } else {
                echo "<script>alert('Error inserting product: " . $stmt->error . "');</script>";
            }
        } else {
            echo "<script>alert('Failed to move uploaded file');</script>";
        }
    } else {
        echo "<script>alert('Image upload error code: " . $_FILES['img']['error'] . "');</script>";
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
      *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      form{
        width: 50%;
        margin: 50px auto;
        padding: 40px;
  padding: 40px;
  background: #f0f8ff; /* very light blue */
  border-radius: 10px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      }
    </style>
  </head>
  <body>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="container mt-5">
        <h2 class="mb-4 text-center">Add New Product</h2>
        <div class="mb-3">
          <label for="productName" class="form-label">Product Name</label>
          <input type="text" class="form-control" id="productName" name="name" required>
        </div>
        <div class="mb-3">
          <label for="productName" class="form-label">Categories ID</label>
          <input type="number" class="form-control" id="productName" name="cat_id" required>
        </div>
        <div class="mb-3">
          <label for="productPrice" class="form-label">Product Price</label>
          <input type="number" class="form-control" id="productPrice" name="price" required>
        </div>
         <div class="mb-3">
          <label for="productPrice" class="form-label">Description</label>
          <input type="text" class="form-control" id="productPrice" name="description" required>
        </div>
        <div class="mb-3">
          <label for="productPrice" class="form-label">Image Product</label>
          <input type="file" class="form-control" id="productPrice" name="img" required>
        </div>
         <div class="mb-3">
            <a href="../product.php" class="btn btn-info rounded-3 text-white">Back</a>
            <button type="submit" name="submit" class="btn btn-primary rounded-3">Add</button>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>