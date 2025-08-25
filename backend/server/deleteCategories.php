<?php
    include("connection.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM categories WHERE cat_id = $id";
        $result = $conn->query($sql);
        if($result){
            header("Location: ../categories.php");
        }
    }
?>