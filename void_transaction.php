<?php
// Include your database connection
include 'connection.php'; // Make sure to provide the correct path

// Check if the request is a POST request and the transactionID is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['transactionID'])) {
    $transactionID = $_POST['transactionID'];

    try {
        // Start a transaction (so changes can be rolled back if something goes wrong)
        $pdo->beginTransaction();

        // Step 1: Update the transaction as voided (VOID = 1)
        $stmt = $pdo->prepare("UPDATE tbfinance SET VOID = 1 WHERE TRANSACTION_ID = :transactionID");
        $stmt->bindParam(':transactionID', $transactionID, PDO::PARAM_INT);
        $stmt->execute();

        // Commit the transaction
        $pdo->commit();

        // Respond with success
        echo json_encode(['status' => 'success', 'message' => 'Transaction voided successfully']);
    } catch (PDOException $e) {
        // If something goes wrong, roll back the transaction
        $pdo->rollBack();
        echo json_encode(['status' => 'error', 'message' => 'Failed to void the transaction: ' . $e->getMessage()]);
    }
}
