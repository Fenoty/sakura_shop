<?php

$host = 'localhost';
$dbname = 'sakkura';
$user = 'postgres';
$pass = '6882';
$port = 5432;

$dsn = "pgsql:host=".$host.";port=".$port.";dbname=".$dbname;
$options = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
}catch(PDOException $e) {
    echo 'Ошибка: Не подключено' . $e->getMessage();
}

