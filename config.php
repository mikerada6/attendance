<?php
$server = "localhost";
$username = "mikerada6";
$password = "";
$database = "swipe";
try{
    $db = new PDO('mysql:host='.$server.';dbname='.$database.';charset=utf8mb4', $username, $password);
}catch (PDOException $e) {
    http_response_code(404);
    echo 'Connection failed: ' . $e->getMessage();
}
    
?>