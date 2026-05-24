<?php
$host       =   getenv('DB_HOST') ?: 'localhost:3307';
$user       =   getenv('DB_USER') ?: 'root';
$password   =   getenv('DB_PASS') ?: '';
$database   =   getenv('DB_NAME') ?: 'barang';
$connect = mysqli_connect($host, $user, $password, $database);
?>
