<?php
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
    exit;
}

// Decode the incoming JSON
$input = json_decode(file_get_contents('php://input'), true);

// Debugging: Log the input received
error_log('Input Received: ' . print_r($input, true));

if (isset($input['filePath']) && !empty($input['filePath'])) {
    $filePath = $input['filePath'];

    // Check if the file exists
    if (file_exists($filePath)) {
        // Simulate processing (replace with actual logic)
        error_log('Processing file: ' . $filePath);
        echo json_encode(['success' => true]);
    } else {
        error_log('File does not exist: ' . $filePath);
        echo json_encode(['success' => false, 'error' => 'File does not exist.']);
    }
} else {
    error_log('File path not provided.');
    echo json_encode(['success' => false, 'error' => 'File path not provided.']);
}
exit;
