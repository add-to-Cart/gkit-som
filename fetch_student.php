<?php
include 'connection.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Base SQL query
$sql = "SELECT STUDENT_NUMBER, CONCAT(LASTNAME, ', ', FIRSTNAME, ' ', MIDDLENAME, ' ', SUFFIX) AS NAME, DEGREE FROM tbsom";

// Check if there is a filter
if ($filter && $filter != 'all') {
    // Modify the SQL based on the filter
    if ($filter == 'fp') {
        $sql .= " WHERE ID_BALANCE <= 0";
    } elseif ($filter == 'wb') {
        $sql .= " WHERE ID_BALANCE > 0";
    }
}

// Check if there is a search term
if (!empty($search)) {
    // Add search condition to the SQL query
    $sql .= ($filter && $filter != 'all') ? " AND" : " WHERE";
    $sql .= " (STUDENT_NUMBER LIKE :search 
              OR FIRSTNAME LIKE :search
              OR LASTNAME LIKE :search
              OR MIDDLENAME LIKE :search
              OR SUFFIX LIKE :search)";
}

$stmt = $pdo->prepare($sql);

// Bind the search parameter if it exists
if (!empty($search)) {
    $stmt->bindValue(':search', '%' . $search . '%');
}

$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($students);
