<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['uploadedFile'])) {
    $uploadDir = 'uploads/';
    $file = $_FILES['uploadedFile'];
    $filePath = $uploadDir . basename($file['name']);
    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

    // Validate file type
    $allowedTypes = ['docx', 'pdf', 'pptx'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Invalid file type. Only DOCX, PDF, and PPTX are allowed.";
        exit;
    }

    // Save uploaded file
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Redirect to review page
        header("Location: review.php?file=" . urlencode($filePath));
        exit;
    } else {
        echo "Failed to upload file.";
    }
}
?>
