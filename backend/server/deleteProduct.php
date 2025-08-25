<?php
include 'connection.php'; 

if (isset($_GET['id'])) {
    $pro_id = $_GET['id'];
    
    $sql = "DELETE FROM products WHERE pro_id = $pro_id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: ../product.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>