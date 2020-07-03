<?php

if(isset($_POST['title'])){
    require 'connection.php';

    $title = $_POST['title'];

    if(empty($title)){
        header("Location: index.php?mess=error");
    }else {
        $stmt = $conn->prepare("INSERT INTO tbl_todo(title) VALUE(?)");
        $res = $stmt->execute([$title]);

        if($res){
            header("Location: index.php?mess=success"); 
        }else {
            header("Location: index.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: index.php?mess=error");
}