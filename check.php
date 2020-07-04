<?php
require 'connection.php';

if(isset($_POST['id'])){
    
    $id = $_POST['id'];

    if(empty($id)){
       echo 'error';
    }else {
        $query = $conn->prepare("SELECT id, checked FROM tbl_todo WHERE id=$id");
        $query->execute([$id]);

        $todo = $query->fetch();
        $uId = $todo['id'];
        $checked = $todo['checked'];

        $uChecked = $checked ? 0 : 1;

        $res = $conn->query("UPDATE tbl_todo SET checked=$uChecked WHERE id=$uId");

        if($res){
            echo $checked;
        }else {
            echo "error";
        }
        exit();
    }
}else {
    header("Location: index.php?mess=error");
}