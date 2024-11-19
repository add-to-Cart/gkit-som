<?php
include 'connection.php'; // Ensure connection is included

// Check if meetingLink is set in the POST data
if (isset($_POST['meetingLink'])) {
    $meetingLink = $_POST['meetingLink']; // Get the meeting link from the POST data

    // Step 1: Get the latest ongoing meeting
    $sql = "SELECT ID FROM tbmeeting WHERE ENDED = 0 ORDER BY ID DESC LIMIT 1"; // Get the latest ongoing meeting
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute(); // Execute the query to get the latest meeting ID
        $meeting = $stmt->fetch(PDO::FETCH_ASSOC);

        // Step 2: If there is an ongoing meeting, update its status to 'ENDED'
        if ($meeting) {
            $meetingID = $meeting['ID']; // Get the ID of the latest ongoing meeting

            // Prepare the SQL statement for updating the meeting's ENDED column
            $updateSql = "UPDATE tbmeeting SET ENDED = 1 WHERE ID = :meetingID";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->bindParam(':meetingID', $meetingID); // Bind the meeting ID parameter

            // Execute the update query
            $updateStmt->execute();

            // Return a success message or updated meeting status
            echo "Meeting status updated to 'ENDED'.";
        } else {
            echo "No ongoing meeting found.";
        }
    } catch (PDOException $e) {
        // Handle any errors
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No meeting link provided.";
}
