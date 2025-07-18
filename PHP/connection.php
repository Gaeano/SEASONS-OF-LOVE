<?php 


    // $host = "localhost";
    // $dbname = "s19010108_seasonsoflove";
    // $user = "s19010108_seasonsoflove";
    // $password = "mutiamanlangitherediasanding2025";
    // $conn = new mysqli($host, $user, $password, $dbname);
    
    // if($conn->connect_error){
    //      die("Connection failed".$conn->connect_error);
    //  }
    //  echo "";
    //  return $conn;


$host = "localhost";
$user = "root";
$password = ""; // default in XAMPP
$dbname = "s19010108_seasonsoflove"; // your database name

$conn = new mysqli("localhost", "root", "", "s19010108_seasonsoflove"); // ✅ working default

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>




