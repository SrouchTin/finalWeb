<?php
  include("connection.php");
    if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM categories WHERE cat_id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// Handle the form submission for update
if (isset($_POST['submit_update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    
    // Initialize the SQL variable to avoid errors if no image is uploaded
    $sql = ""; 

    // Check if new image is uploaded
    if (!empty($_FILES['img']['name'])) {
        $file_name = $_FILES['img']['name'];
        $tmp_name = $_FILES['img']['tmp_name'];
        
        // Define the path to move the file to on the server
        $server_path = "../../image/categories/" . $file_name;

        // Define the clean path to store in the database
        $db_path = "image/categories/" . $file_name;

        // Move uploaded file and then build the SQL query
        if (move_uploaded_file($tmp_name, $server_path)) {
            $sql = "UPDATE categories SET cat_name = '$name', img = '$db_path' WHERE cat_id = $id";
        } else {
            die("Error: Failed to upload image.");
        }
    } else {
        // If no new image is uploaded, update without changing the image path
        $sql = "UPDATE categories SET cat_name = '$name' WHERE cat_id = $id";
    }

    // Execute update if the query variable is not empty
    if (!empty($sql) && mysqli_query($conn, $sql)) {
        header("Location: ../categories");
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
    <form action="updateCategories.php" method="post" enctype="multipart/form-data">
      <div class="container mt-5">
        <h2 class="mb-4 text-center">Update Categories</h2>
        <input type="hidden" name="id" value="<?= $row['cat_id'] ?>">
        <div class="mb-3">
          <label for="productName" class="form-label">Categories Name</label>
          <input type="text" class="form-control" id="productName" name="name" value="<?php echo $row['cat_name'] ?>" required>
        </div>
        <div class="mb-3">
          <label for="productPrice" class="form-label">Image Categories</label>
          <img src="../../<?php echo $row['img'] ?>" alt="Category image" class="img-fluid mb-3" style="width: 100px; height: 100px; object-fit: cover;">
          <input type="file" class="form-control" id="productPrice" name="img">
        </div>
         <div class="mb-3">
            <a href="../categories.php" class="btn btn-info rounded-3">Back</a>
            <button type="submit" name="submit_update" class="btn btn-primary rounded-3">Update</button>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>