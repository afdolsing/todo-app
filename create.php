<?php
require 'connection.php';

if(isset($_POST['title'])){
   
    $title = htmlspecialchars($_POST['title']);

    if(empty($title)){
        header("Location: index.php?mess=error");
    }else {
        $query = $conn->prepare("INSERT INTO tbl_todo(title) VALUE('$title')");
        $result = $query->execute([$title]);

        if($result){
            header("Location: index.php?mess=success"); 
        }else {
            header("Location: index.php");
        }
        exit();
    }
}else {
    header("Location: index.php?mess=error");
}