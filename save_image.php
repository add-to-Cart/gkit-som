<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'output/'; // Directory where images will be saved

        // Ensure the directory exists, create it if it doesn't
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Generate a unique filename to avoid overwriting
        $fileName = basename($_FILES['image']['name']);
        $pathFileName = $uploadDir . $fileName;

        // Move the file to the server
        if (move_uploaded_file($_FILES['image']['tmp_name'], $pathFileName)) {
            echo json_encode(['status' => 'success', 'path' => $pathFileName]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save the image.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid file upload.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
