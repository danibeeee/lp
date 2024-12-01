<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_FILES['uploadedFile'])) {
    $fileName = $_FILES['uploadedFile']['name'];
    $fileTmpName = $_FILES['uploadedFile']['tmp_name'];

    if (move_uploaded_file($fileTmpName, 'uploads/' . $fileName)) {
        echo "File uploaded successfully to /uploads/$fileName";
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "No file received.";
}
?>
