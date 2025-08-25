<?php
include 'connection.php'; 

if (isset($_GET['id'])) {
    $pro_id = $_GET['id'];
    
    $sql = "DELETE FROM banner WHERE id = $pro_id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: ../banner.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>