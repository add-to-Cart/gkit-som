<?php
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

    // Prepare the SQL UPDATE statement
    $stmt = $pdo->prepare("UPDATE tbsom SET STATUS = ?, DEGREE = ?, FIRSTNAME = ?, MIDDLENAME = ?, LASTNAME = ?, SUFFIX = ?, GENDER = ?, BIRTHDATE = ?, ADDRESS = ?, CONTACT = ?, EMAIL = ?, CHURCH = ?, PASTOR = ?, MINISTRY = ?, DATE_IN_GKMCC = ?, E_NAME = ?, E_RELATIONSHIP = ?, E_CONTACT = ?, BALANCE = ?, ID_BALANCE = ?, TOTAL_PAYMENT = ? WHERE STUDENT_NUMBER = ?");

    // Execute the statement with the provided data
    if ($stmt->execute([$status, $degree, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $address, $contact, $email, $church, $pastor, $ministry, $joined_date, $e_name, $e_relationship, $e_contact, $balance, $id_balance, $total_payment, $student_number])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update student.']);
    }
}
