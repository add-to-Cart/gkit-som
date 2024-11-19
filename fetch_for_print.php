<?php
// Include the database connection
include 'connection.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json'); // Set the content type to JSON

try {
    // Prepare the SQL statement
    $stmt = $pdo->prepare("SELECT * FROM tbsom WHERE ID_BALANCE <= 0");

    // Execute the query
    $stmt->execute();

    // Fetch results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array

    // Return the results as JSON
    echo json_encode($results);
} catch (PDOException $e) {
    // Return an error message as JSON
    echo json_encode(['error' => $e->getMessage()]);
}
