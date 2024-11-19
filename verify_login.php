<?php
session_start();
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accountNumber = $_POST['account_number'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($accountNumber) || empty($password)) {
        echo '<p class="text-red-500">Both fields are required.</p>';
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM tbsom_users WHERE ACCOUNT_NUMBER = :account_number");
        $stmt->bindParam(':account_number', $accountNumber);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and passwords match
        if ($user && $user['PASSWORD'] === $password) {
            $_SESSION['AccNumber'] = $user['ACCOUNT_NUMBER'];
            $_SESSION['AccessLevel'] = $user['ACCESS_LEVEL'];
            $_SESSION['EmployeeName'] = $user['NAME'];
            echo '<p class="text-green-500">Login successful! Redirecting...</p>';
            echo '<script>setTimeout(() => { window.location.href = "index.php"; }, 2000);</script>';
        } else {
            echo '<p class="text-red-500">Invalid credentials. Please try again.</p>';
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo '<p class="text-red-500">An error occurred. Please try again later.</p>';
    }
}
