<?php
$dsn = 'mysql:host=localhost;dbname=y_store';
$username = 'root';
$password = '';
$option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
try {
    $connection = new PDO($dsn, $username, $password, $option);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo ($error_message);
}
