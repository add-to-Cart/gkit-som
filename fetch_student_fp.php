<?php
include 'connection.php';

header('Content-Type: application/json'); // Set header for JSON output

try {
    // Query to fetch student data
    $query = "SELECT STUDENT_NUMBER, CONCAT(LASTNAME, ', ', FIRSTNAME, ' ', MIDDLENAME, ' ', SUFFIX) AS NAME, DEGREE FROM tbsom WHERE ID_BALANCE <= 0";
    $stmt = $pdo->query($query);

    $students = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $students[] = $row;
    }

    // Output data in JSON format
    echo json_encode($students);
    exit; // Ensure script stops after output
} catch (PDOException $e) {
    // Error handling
    echo json_encode(["error" => "Failed to fetch data: " . $e->getMessage()]);
    exit; // Ensure script stops after output
}
