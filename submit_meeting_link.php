<?php
// Include the database connection
include 'connection.php';

// Check if meetingLink is set in the POST data
if (isset($_POST['meetingLink'])) {
    $meetingLink = $_POST['meetingLink'];

    // Prepare the SQL statement for insertion, including the ENDED field
    $sql = "INSERT INTO tbmeeting (MEETING_LINK, ENDED) 
            VALUES (:meetingLink, 0)";  // Set ENDED to 0 (indicating the meeting is ongoing)

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':meetingLink', $meetingLink); // Bind the meetingLink parameter

    try {
        $stmt->execute(); // Execute the query



    } catch (PDOException $e) {
        // Handle any errors
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No meeting link provided.";
}
