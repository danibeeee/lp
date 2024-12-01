<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Select Game Mode</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Select Game Mode</h1>
    <button onclick="startMode('classic')">Classic</button>
    <button onclick="startMode('crossword')">Crossword</button>
    <button onclick="startMode('jumble')">Jumble</button>
  </div>

  <script>
    function startMode(mode) {
      window.location.href = `gameplay.php?mode=${mode}`;
    }
  </script>
  <?php
echo "Welcome to the Game Mode Selection Page!";
exit;
?>
</body>
</html>
