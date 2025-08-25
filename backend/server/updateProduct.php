<?php
include("connection.php");

// Get data by ID to pre-fill the form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE pro_id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// Handle the form submission for update
if (isset($_POST['submit_update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $cat_id = $_POST['cat_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    // Initialize the SQL variable to avoid errors if no image is uploaded
    $sql = ""; 

    // Check if new image is uploaded
    if (!empty($_FILES['img']['name'])) {
        $file_name = $_FILES['img']['name'];
        $tmp_name = $_FILES['img']['tmp_name'];
        
        // Define the path to move the file to on the server
        $server_path = "../../image/products/" . $file_name;

        // Define the clean path to store in the database
        $db_path = "image/products/" . $file_name;

        // Move uploaded file and then build the SQL query
        if (move_uploaded_file($tmp_name, $server_path)) {
            $sql = "UPDATE products SET pro_name = '$name', cat_id = '$cat_id', price = '$price' , description = '$description', img = '$db_path' WHERE pro_id = $id";
        } else {
            die("Error: Failed to upload image.");
        }
    } else {
        // If no new image is uploaded, update without changing the image path
        $sql = "UPDATE products SET pro_name = '$name', cat_id = '$cat_id', price = '$price', description = '$description' WHERE pro_id = $id";
    }

    // Execute update if the query variable is not empty
    if (!empty($sql) && mysqli_query($conn, $sql)) {
        header("Location: ../product.php");
        exit();
    } else {
        echo "Update failed: " . mysqli_error($conn);
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
        background: linear-gradient(135deg, #f9f9f9, #e9eef3);
        border-radius: 5px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      }
    </style>
  </head>
  <body>
    <form action="updateProduct.php" method="post" enctype="multipart/form-data">
      <div class="container mt-5">
        <h2 class="mb-4 text-center">Update Product</h2>
        <input type="hidden" name="id" value="<?= $row['pro_id'] ?>">
        <div class="mb-3">
          <label for="productName" class="form-label">Product Name</label>
          <input type="text" class="form-control" id="productName" name="name" value="<?php echo $row['pro_name'] ?>" required>
        </div>
        <div class="mb-3">
          <label for="productName" class="form-label">Categories ID</label>
          <input type="number" class="form-control" id="productName" name="cat_id" value="<?php echo $row['cat_id'] ?>" required>
        </div>
        <div class="mb-3">
          <label for="productPrice" class="form-label">Product Price</label>
          <input type="number" class="form-control" id="productPrice" name="price" value="<?php echo $row['price'] ?>" required>
        </div>
         <div class="mb-3">
          <label for="productPrice" class="form-label">Description</label>
          <input type="text" class="form-control" id="productPrice" name="description" value="<?php echo $row['description'] ?>" required>
        </div>
        <div class="mb-3">
          <label for="productPrice" class="form-label">Image Product</label>
          <img src="../../<?php echo $row['img'] ?>" alt="product image" class="img-fluid mb-3" style="width: 100px; height: 100px; object-fit: cover;">
          <input type="file" class="form-control" id="productPrice" name="img">
        </div>
         <div class="mb-3">
            <a href="../product.php" class="btn btn-info rounded-3 text-white">Back</a>
            <button type="submit" name="submit_update" class="btn btn-primary rounded-3">Update</button>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>