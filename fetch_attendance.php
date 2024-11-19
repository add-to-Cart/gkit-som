<?php
include 'connection.php';

// Receive search, date, and filter parameters from AJAX request
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'present'; // Default to "present"
$date = isset($_GET['date']) ? $_GET['date'] : '';

// Base SQL query
$sql = "SELECT STUDENT_NUMBER, NAME, ATTENDANCE, TIME_IN, DATE_ATTENDED FROM tbsom_attendance";
$conditions = [];

// Add filter condition
if ($filter === 'present') {
    $conditions[] = "ATTENDANCE = '1'";
} elseif ($filter === 'absent') {
    $conditions[] = "ATTENDANCE = '0'";
}

// Add date condition if provided
if (!empty($date)) {
    $conditions[] = "DATE_ATTENDED = :date";
}

// Add search condition if provided
if (!empty($search)) {
    $conditions[] = "(NAME LIKE :search OR STUDENT_NUMBER LIKE :search)";
}

// Combine conditions with "WHERE" clause
if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$stmt = $pdo->prepare($sql);

// Bind date parameter if provided
if (!empty($date)) {
    $stmt->bindValue(':date', $date);
}

// Bind search parameter if provided
if (!empty($search)) {
    $stmt->bindValue(':search', '%' . $search . '%');
}

$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return data as JSON
echo json_encode($students);
