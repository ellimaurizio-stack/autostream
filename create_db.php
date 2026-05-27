<?php
$host = '127.0.0.1';
$port = 5432;
$user = 'postgres';
$pass = '';

$dsn = "pgsql:host=$host;port=$port;dbname=postgres";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
    // Check if db exists
    $stmt = $pdo->query("SELECT 1 FROM pg_database WHERE datname = 'autostream'");
    if (!$stmt->fetch()) {
        $pdo->exec("CREATE DATABASE autostream");
        echo "Database created successfully\n";
    } else {
        echo "Database already exists\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
