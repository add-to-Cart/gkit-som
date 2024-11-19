<?php
$dsn = 'mysql:host=localhost;dbname=dbgkmcc';
$username = 'root'; // Replace 'your_username' with your actual database username
$password = ''; // Replace 'your_password' with your actual database password

try {
    $pdo = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo; // Return the PDO object for easy inclusion in other scripts
} catch (PDOException $e) {
    // Log error in production environments
    error_log("Connection failed: " . $e->getMessage());
    die("Database connection error."); // Hide details from the user
}
