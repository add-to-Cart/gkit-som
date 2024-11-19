<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the AJAX request
    $student_number = $_POST['student_number'];
    $status = $_POST['status'];
    $degree = $_POST['degree'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $suffix = $_POST['suffix'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $church = $_POST['church'];
    $pastor = $_POST['pastor'];
    $ministry = $_POST['ministry'];
    $joined_date = $_POST['joined_date'];
    $e_name = $_POST['e_name'];
    $e_relationship = $_POST['e_relationship'];
    $e_contact = $_POST['e_contact'];
    $balance = $_POST['balance'];
    $id_balance = $_POST['id_balance'];
    $total_payment = $_POST['total_payment'];

    // Check if the student number or name already exists
    $checkQuery = $pdo->prepare("SELECT * FROM tbsom WHERE STUDENT_NUMBER = ? OR (FIRSTNAME = ? AND LASTNAME = ?)");
    $checkQuery->execute([$student_number, $firstname, $lastname]);

    // If a record is found, return an error response for duplicate entry
    if ($checkQuery->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'Student already exists with the same number or name.']);
    } else {
        // Prepare the SQL INSERT statement
        $stmt = $pdo->prepare("INSERT INTO tbsom (STUDENT_NUMBER, STATUS, DEGREE, FIRSTNAME, MIDDLENAME, LASTNAME, SUFFIX, GENDER, BIRTHDATE, ADDRESS, CONTACT, EMAIL, CHURCH, PASTOR, MINISTRY, DATE_IN_GKMCC, E_NAME, E_RELATIONSHIP, E_CONTACT, BALANCE, TOTAL_PAYMENT, ID_BALANCE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Execute the statement with the provided data
        if ($stmt->execute([$student_number, $status, $degree, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $address, $contact, $email, $church, $pastor, $ministry, $joined_date, $e_name, $e_relationship, $e_contact, $balance, $total_payment, $id_balance])) {
            echo json_encode(['success' => true, 'message' => 'Student enrolled successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to enroll student.']);
        }
    }
} else {
    // If the request method is not POST, return an error message
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
