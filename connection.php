<?php

    $server = 'localhost';
    $user   = 'root';
    $pass   = '';
    $db_name= 'db_pdo_todo';

    // koneksikan menggunakan PDO -> PHP Data Object
    try{
        $conn = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Connection failed : ". $e->getMessage();
    }
    


