<?php
// Process answers and compare with correct answers
$submittedAnswers = $_POST['answer'];
$score = 0;

// Assuming the correct answers are stored in the database or passed in the session
foreach ($submittedAnswers as $index => $answer) {
    if (strtolower($answer) == strtolower($correctAnswers[$index])) {  // Compare answers case-insensitively
        $score++;
    }
}

// Show results
echo "<h2>You got $score out of " . count($correctAnswers) . " correct!</h2>";
?>
