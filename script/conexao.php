<?php
$dsn = 'mysql:host=localhost;dbname=repositorio';
$user = 'root';
$password = '';

try{
    $database = new PDO($dsn, $user, $password);
}catch(PDO $exception){
    echo $exception;
}
?>