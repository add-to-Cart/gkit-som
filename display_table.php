<?php
include 'connection.php';

header('Content-Type: application/json');

if (isset($_GET['student_number'])) {
    $student_number = $_GET['student_number'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM tbsom WHERE STUDENT_NUMBER = :student_number");
        $stmt->bindParam(':student_number', $student_number, PDO::PARAM_STR);
        $stmt->execute();

        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            echo json_encode($student);
        } else {
            echo json_encode(['error' => 'No student found with the given student number.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Student number not provided.']);
}
