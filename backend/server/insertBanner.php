<?php
    include("connection.php");
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $des   = $_POST['des'];
        $namebtn = $_POST['namebtn'];
        if ($_FILES['img']['error'] === 0) {
        $imgName = basename($_FILES['img']['name']);
        $tmp_name = $_FILES['img']['tmp_name'];

        // Save in projectETEC/image/products/
        $targetDir = "../../image/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . $imgName;

        if (move_uploaded_file($tmp_name, $targetFile)) {
            // Save relative path to DB
            $imgPath = "image/" . $imgName;

            $sql = "INSERT INTO banner (img,name,description,button) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $imgPath, $title,$des,$namebtn);

            if ($stmt->execute()) {
                echo "<script>alert('Banner Inserted Successfully!'); window.location.href='../banner.php';</script>";
            } else {
                echo "<script>alert('Error inserting Banner: " . $stmt->error . "');</script>";
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
        <h2 class="mb-4 text-center">Add New Banner</h2>
        <div class="mb-3">
          <label for="Title" class="form-label">Title</label>
          <input type="text" class="form-control" name="title" required>
        </div>
        <div class="mb-3">
          <label for="Description" class="form-label">Description</label>
          <input type="text" class="form-control" name="des" required>
        </div>
        <div class="mb-3">
          <label for="nameButton" class="form-label">Name button</label>
          <input type="text" class="form-control" name="namebtn" required>
        </div>
        <div class="mb-3">
          <label for="Image" class="form-label">Image</label>
          <input type="file" class="form-control"  name="img" required>
        </div>
         <div class="mb-3">
            <a href="../banner.php" class="btn btn-info rounded-3 text-white">Back</a>
            <button type="submit" name="submit" class="btn btn-primary rounded-3">Add</button>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>