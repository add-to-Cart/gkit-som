<?php
// Include the connection file
require_once 'connection.php';

// Check if input data is available
if (isset($_POST['totalClasses']) && isset($_POST['threshold'])) {
    $totalClasses = (int)$_POST['totalClasses'];
    $threshold = (int)$_POST['threshold'];

    try {
        // Prepare SQL query to fetch students with 50% or more absences
        $sql = "
            SELECT STUDENT_NUMBER, NAME, COUNT(*) AS absences
            FROM tbsom_attendance
            WHERE ATTENDANCE = '0' 
            GROUP BY STUDENT_NUMBER, NAME
            HAVING absences >= :threshold
        ";

        // Prepare and execute the statement
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':threshold', $threshold, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the result
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return result as JSON
        if ($students) {
            echo json_encode(['success' => true, 'students' => $students]);
        } else {
            echo json_encode(['success' => false, 'students' => []]);
        }
    } catch (PDOException $e) {
        // Handle database error
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // Handle missing input data
    echo json_encode(['success' => false, 'message' => 'Invalid input data']);
}
