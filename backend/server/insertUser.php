<?php
   include("connection.php");
    if (isset($_POST['submit'])) {
         $name = $_POST['name'];
         $email = $_POST['email'];
         $password = $_POST['password'];
    
         $sql = "INSERT INTO users (fullName, email, password) VALUES ('$name', '$email', '$password')";
         if ($conn->query($sql) === TRUE) {
              header("Location: ../users.php");
         } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
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
    <form action="insertUser.php" method="post" >
      <div class="container mt-5">
        <h2 class="mb-4 text-center">Add New User</h2>
        <div class="mb-3">
          <label  class="form-label">FullName</label>
          <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
          <label  class="form-label">Email</label>
          <input type="email" class="form-control"  name="email" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control"  name="password" required>
        </div>
         <div class="mb-3">
            <a href="../users.php" class="btn btn-info rounded-3 text-white">Back</a>
            <button type="submit" name="submit" class="btn btn-primary rounded-3">Add</button>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>