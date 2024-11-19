<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
include 'connection.php';

// Function to generate a random 11-digit TRANSACTION_ID
function generateTransactionId()
{
    return str_pad(random_int(0, 99999999999), 11, '0', STR_PAD_LEFT); // Ensures it's 11 digits
}

// Function to check if a TRANSACTION_ID exists in the database
function transactionIdExists($pdo, $transactionId)
{
    $stmt = $pdo->prepare("SELECT 1 FROM tbfinance WHERE TRANSACTION_ID = ? LIMIT 1");
    $stmt->execute([$transactionId]);
    return $stmt->fetchColumn() !== false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_number = $_POST['student_number'] ?? '';
    $status = $_POST['status'] ?? '';
    $degree = $_POST['degree'] ?? '';
    $enrollment_fee = $_POST['enrollment_fee'] ?? '';
    $amount_paid = $_POST['total_payment'] ?? '';
    $balance = $_POST['balance'] ?? '';
    $id_balance = $_POST['id_balance'] ?? '';
    $employee_name = $_SESSION['EmployeeName'] ?? '';
    $payment_description = $_POST['payment_description'] ?? '';

    try {
        $pdo->beginTransaction(); // Start transaction

        // Generate a unique TRANSACTION_ID
        $transaction_id = '';
        $attempts = 0;
        do {
            $transaction_id = generateTransactionId();
            $attempts++;

            if ($attempts >= 10) {
                throw new Exception('Failed to generate a unique transaction ID after multiple attempts.');
            }
        } while (transactionIdExists($pdo, $transaction_id));

        // Insert the record into the database
        $stmt = $pdo->prepare("INSERT INTO tbfinance 
            (TRANSACTION_ID, STUDENT_NUMBER, STATUS, DEGREE, ENROLLMENT_FEE, AMOUNT_PAID, BALANCE, ID_BALANCE, PAYMENT_DESCRIPTION, EMPLOYEE) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $transaction_id,
            $student_number,
            $status,
            $degree,
            $enrollment_fee,
            $amount_paid,
            $balance,
            $id_balance,
            $payment_description,
            $employee_name
        ]);

        $pdo->commit(); // Commit transaction
        echo json_encode(['success' => true, 'message' => 'Record added successfully.', 'transaction_id' => $transaction_id]);
    } catch (Exception $e) {
        $pdo->rollBack(); // Roll back on error
        error_log($e->getMessage()); // Log error
        echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
