<?php
   include("connection.php");
    if (isset($_POST['submit'])) {
         $name = $_POST['name'];
         $email = $_POST['email'];
         $password = $_POST['password'];
    
         $sql = "INSERT INTO users (fullName, email, password) VALUES ('$name', '$email', '$password')";
         if ($conn->query($sql) === TRUE) {
              header("Location: ../../index.php");
         } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
         }
    }
?>