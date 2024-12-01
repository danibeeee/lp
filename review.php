<?php
if (!isset($_GET['file'])) {
    echo "No file specified.";
    exit;
}

$filePath = urldecode($_GET['file']);
$fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Review File</title>
  <link rel="stylesheet" href="styles.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
</head>
<body>
  <div class="container">
    <h1>Review Your File</h1>

    <?php if ($fileType === 'pdf'): ?>
      <iframe src="<?php echo $filePath; ?>" width="100%" height="600px"></iframe>
    <?php elseif ($fileType === 'docx' || $fileType === 'pptx'): ?>
      <a href="<?php echo $filePath; ?>" download>Download File for Review</a>
    <?php else: ?>
      <p>Unsupported file type for preview.</p>
    <?php endif; ?>

    <button onclick="window.location.href='upload.html'">Back to Upload</button>
    <button id="startGameBtn">Start Game</button>
  </div>

  document.getElementById('startGameBtn').addEventListener('click', function () {
  const filePath = '<?php echo $filePath; ?>';

  // Send file for processing
  fetch('process_file.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ filePath: filePath })
  })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      if (data.success) {
        console.log('File processed successfully:', data);
        // Redirect to the game mode selection page
        window.location.href = 'start_game.php';
      } else {
        alert(data.error || 'Failed to start the game.');
        console.error('Error response from server:', data);
      }
    })
    .catch(error => {
      alert('An error occurred while processing the file.');
      console.error('Fetch error:', error);
    });
});
<script>
    console.log("File path passed to process_file.php: <?php echo $filePath; ?>");
</script>
</body>
</html>
