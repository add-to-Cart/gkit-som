<?php
header('Content-Type: application/json');
require 'connection.php'; // Adjust to your DB connection file

try {
    // Initialize the base query
    $query = "
        SELECT 
            f.TRANSACTION_ID,
            f.STUDENT_NUMBER,
            CONCAT(s.LASTNAME, ' ', s.FIRSTNAME, ' ', s.MIDDLENAME, ' ', s.SUFFIX) AS NAME,
            f.STATUS,
            f.DEGREE,
            f.AMOUNT_PAID,
            f.BALANCE,
            f.PAYMENT_DESCRIPTION,
            f.EMPLOYEE,
            f.DATE_CREATED
        FROM tbfinance f
        INNER JOIN tbsom s ON f.STUDENT_NUMBER = s.STUDENT_NUMBER WHERE VOID = 0
    ";

    // Initialize an array to store query conditions
    $conditions = [];
    $params = [];

    // Check for date filter
    if (!empty($_GET['date'])) {
        $conditions[] = "DATE(f.DATE_CREATED) = :date";
        $params[':date'] = $_GET['date'];
    }

    // Check for search filter (example for searching by name or student number)
    if (!empty($_GET['search'])) {
        $conditions[] = "(s.LASTNAME LIKE :search OR s.FIRSTNAME LIKE :search OR f.STUDENT_NUMBER LIKE :search)";
        $params[':search'] = '%' . $_GET['search'] . '%';
    }

    // If there are conditions, add them to the query
    if (count($conditions) > 0) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    // Prepare and execute the query with conditions
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $finances = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['transactions' => $finances]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
