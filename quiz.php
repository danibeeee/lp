<?php
session_start();

// Retrieve questions from session
$questions = isset($_SESSION['questions']) ? $_SESSION['questions'] : [];

// Handle quiz rendering
if (empty($questions)) {
    echo "No questions available. Please upload a valid file.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - Classic Mode</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Your styling here */
        .button {
            padding: 15px 30px;
            background-color: #0095A9;
            color: white;
            border: none;
            cursor: pointer;
            font-family: 'Press Start 2P', cursive;
            font-size: 16px;
            border-radius: 10px;
        }
        .button:hover {
            background-color: #007a8c;
        }
        .question-box {
            width: 80%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .timer {
            font-size: 20px;
            font-family: 'Press Start 2P', cursive;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="quiz-box">
        <h1 class="title">Classic Mode Quiz</h1>
        <p class="subtitle">Test your knowledge based on the uploaded file!</p>

        <form action="submit_quiz.php" method="POST">
            <?php
            foreach ($questions as $index => $q) {
                echo "<div class='question'>";
                echo "<p><strong>Question " . ($index + 1) . ":</strong> " . $q['question'] . "</p>";

                if ($q['type'] == 'true_false') {
                    echo "<label><input type='radio' name='question{$index}' value='True'> True</label>";
                    echo "<label><input type='radio' name='question{$index}' value='False'> False</label>";
                } elseif ($q['type'] == 'multiple_choice') {
                    foreach ($q['options'] as $option) {
                        echo "<label><input type='radio' name='question{$index}' value='{$option}'> {$option}</label>";
                    }
                } elseif ($q['type'] == 'fill_in_blank') {
                    echo "<input type='text' name='question{$index}' placeholder='Your answer...'>";
                }

                echo "</div>";
            }
            ?>

            <button type="submit">Submit Answers</button>
        </form>
    </div>
</div>

</body>
</html>