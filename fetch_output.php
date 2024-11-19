<?php
// getStudentsWithNoBalance.php
session_start(); // Start the session

require 'connection.php';

try {
    $query = isset($_GET['query']) ? $_GET['query'] : '';

    $sql = "SELECT STUDENT_NUMBER FROM tbsom WHERE ID_BALANCE <= 0";
    if ($query) {
        $sql .= " AND (FIRSTNAME LIKE :query OR LASTNAME LIKE :query OR MIDDLENAME LIKE :query OR SUFFIX LIKE :query OR STUDENT_NUMBER LIKE :query)";
    }

    $stmt = $pdo->prepare($sql);
    if ($query) {
        $stmt->bindValue(':query', '%' . $query . '%');
    }
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Count the number of students and store it in a session variable
    $_SESSION['student_count_no_balance'] = count($students);

    echo json_encode($students);
} catch (PDOException $e) {
    error_log("Query failed: " . $e->getMessage());
    echo json_encode(['error' => 'An error occurred while fetching students.']);
}
