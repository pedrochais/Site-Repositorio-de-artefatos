<?php
$dsn = 'mysql:host=localhost;dbname=repositorio';
$user = 'root';
$password = '';

try {
    $database = new PDO($dsn, $user, $password);
} catch (PDO $exception) {
    header('Location: errobd.php');
} catch (PDOException $exception) {
    header('Location: errobd.php');
}
