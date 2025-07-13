<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "db";
    $conn = new mysqli($servername, $username, $password, $db_name, 3306);
    
    if($conn->connect_error){
        die("Connection failed".$conn->connect_error);
    }
    echo "";
    return $conn;


    // $host = "localhost";
    // $dbname = "s19010108_seasonsoflove";
    // $user = "s19010108_seasonsoflove";
    // $password = "mutiamanlangitherediasanding2025";
    // $conn = new mysqli($host, $user, $password, $dbname);
    
    // if($conn->connect_error){
    //     die("Connection failed".$conn->connect_error);
    // }
    // echo "";
    // return $conn;

?>

