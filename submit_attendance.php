<?php
include 'connection.php'; // Ensure connection is included

// Check if POST data exists and decode it
if (isset($_POST['attendanceData'])) {
    // Decode the raw POST data
    $attendanceData = json_decode($_POST['attendanceData'], true);

    // Check if the data is valid
    if ($attendanceData) {
        error_log(print_r($attendanceData, true)); // Logs the data to the PHP error log
    } else {
        error_log("No data received or JSON decode failed.");
        echo json_encode(['status' => 'error', 'message' => 'Invalid data format.']);
        exit;  // Stop execution if data is invalid
    }

    // Prepare the SQL statement for insertion
    $sql = "INSERT INTO tbsom_attendance (STUDENT_NUMBER, NAME, ATTENDANCE, TIME_IN, DATE_ATTENDED) 
            VALUES (:studentNumber, :name, :attendance, :timeIn, :dateAttended)";

    $stmt = $pdo->prepare($sql);
    $errors = [];  // Array to collect any error messages

    // Loop through each student's data and insert it into the database
    foreach ($attendanceData as $student) {
        // Ensure each student has all required fields before inserting
        if (isset($student['studentNumber'], $student['name'], $student['attendance'], $student['timeIn'], $student['dateAttended'])) {
            try {
                // Execute statement for each student's attendance
                $stmt->execute([
                    ':studentNumber' => htmlspecialchars($student['studentNumber']),
                    ':name' => htmlspecialchars($student['name']),
                    ':attendance' => htmlspecialchars($student['attendance']),
                    ':timeIn' => $student['timeIn'],
                    ':dateAttended' => $student['dateAttended']
                ]);
            } catch (PDOException $e) {
                // Capture any database errors
                $errors[] = $e->getMessage();
            }
        } else {
            // Log an error if any student is missing necessary fields
            $errors[] = "Missing data for student: " . print_r($student, true);
        }
    }

    // Return success or error message based on the operation
    if (empty($errors)) {
        echo json_encode(['status' => 'success']);
    } else {
        // Log errors for debugging
        error_log(implode("\n", $errors));
        echo json_encode(['status' => 'error', 'message' => 'Insert failed.', 'errors' => $errors]);
    }
} else {
    // If attendanceData is not set, return an error
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
