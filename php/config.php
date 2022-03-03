<?php


$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,    
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

// Now you create your connection string
try {
    // Then pass the options as the last parameter in the connection string
    $conn = new PDO("mysql:host=localhost; dbname=real_estate", 'root', '', $options);

    // That's how you can set multiple attributes
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
