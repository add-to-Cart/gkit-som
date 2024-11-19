<?php
include 'connection.php'; // Ensure connection is included

// Define the SQL query to fetch the latest row where ENDED = '0'
$sql = "SELECT * FROM tbmeeting WHERE ENDED = 0 ORDER BY ID DESC LIMIT 1";

// Initialize variables
$activeMeetingStatus = "No ongoing meetings";  // Default status
$activeMeetingLink = null;  // Default value for link

// Execute the query and fetch the results
try {
    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch the result as an associative array
    $meeting = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if there is an ongoing meeting
    if ($meeting) {
        // Set the status and link for the active meeting
        $activeMeetingStatus = "Ongoing";
        $activeMeetingLink = "<a href='" . $meeting['MEETING_LINK'] . "' target='_blank' class='text-blue-600 hover:underline'>" . $meeting['MEETING_LINK'] . "</a>";  // Make the link clickable

        // Store the active meeting data in session
        $_SESSION['activeMeetingStatus'] = $activeMeetingStatus;
        $_SESSION['activeMeetingLink'] = $activeMeetingLink;
    }
} catch (PDOException $e) {
    // Handle any errors that occur during the query execution
    echo "Error: " . $e->getMessage();
}

// You can output the session data directly or just return a success message
echo json_encode([
    'status' => $activeMeetingStatus,
    'link' => $activeMeetingLink
]);
