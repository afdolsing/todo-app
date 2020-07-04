<?php
require 'connection.php';

if(isset($_POST['id'])){
    
    $id = $_POST['id'];

    if(empty($id)){
       echo 0;
    }else {
        $query = $conn->prepare("DELETE FROM tbl_todo WHERE id=$id");
        $result = $query->execute([$id]);

        if($result){
            echo 1;
        }else {
            echo 0;
        }
        exit();
    }
}else {
    header("Location: index.php?mess=error");
}