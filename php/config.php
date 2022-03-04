<?php

$dsn = 'mysql:dbname=real_estate;host=localhost';
$user = 'root';
$password = '';

try {

    $conn = new PDO($dsn, $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {

    echo "erreur:" . $e->getMessage();
    //throw $th;
}
