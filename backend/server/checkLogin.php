<?php
    session_start();
   include("connection.php");
   if(isset($_POST['submit'])) {
       $email = $_POST['email'];
       $password = $_POST['password'];

       // Prepare and bind
       $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
       $stmt->bind_param("ss", $email, $password);
       
       // Execute the statement
       $stmt->execute();
       
       // Get the result
       $result = $stmt->get_result();
       
       if ($result->num_rows > 0) {
           // User exists, proceed with login
            $_SESSION['login'] = "admin";
           header("Location: ../index.php");
       } else {
           echo "<script>alert('Incorrect Email And Passowrd...!')</script>";
           header("Location: ../../index.php");
       }
       
       // Close the statement
       $stmt->close();
   }
?>