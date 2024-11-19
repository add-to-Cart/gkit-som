<?php
include 'connection.php';

$studentNumber = isset($_GET['student_number']) ? $_GET['student_number'] : '';

// Prepare SQL queries for absent and present counts
$sqlAbsent = "SELECT COUNT(*) AS absent_count FROM tbsom_attendance WHERE STUDENT_NUMBER = :student_number AND ATTENDANCE = '0'";
$sqlPresent = "SELECT COUNT(*) AS present_count FROM tbsom_attendance WHERE STUDENT_NUMBER = :student_number AND ATTENDANCE = '1'";

// Absent count
$stmtAbsent = $pdo->prepare($sqlAbsent);
$stmtAbsent->bindValue(':student_number', $studentNumber);
$stmtAbsent->execute();
$absentCount = $stmtAbsent->fetch(PDO::FETCH_ASSOC)['absent_count'];

// Present count
$stmtPresent = $pdo->prepare($sqlPresent);
$stmtPresent->bindValue(':student_number', $studentNumber);
$stmtPresent->execute();
$presentCount = $stmtPresent->fetch(PDO::FETCH_ASSOC)['present_count'];

// Return the counts as JSON
echo json_encode(['absent_count' => $absentCount, 'present_count' => $presentCount]);
