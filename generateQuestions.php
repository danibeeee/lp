function generateQuestions($text) {
    // Split the text into sentences
    $sentences = explode('.', $text);
    $questions = [];

    foreach ($sentences as $sentence) {
        $sentence = trim($sentence);
        
        // Skip empty sentences
        if (strlen($sentence) > 0) {
            
            // Attempt to generate questions based on types of statements
            if ($this->isFact($sentence)) {
                // Generate a factual True/False question
                $questions[] = $this->generateTrueFalseQuestion($sentence);
            } elseif ($this->isDefinition($sentence)) {
                // Generate a Fill-in-the-Blank question for definitions
                $questions[] = $this->generateFillInBlankQuestion($sentence);
            } else {
                // Otherwise, generate a Multiple Choice question
                $questions[] = $this->generateMultipleChoiceQuestion($sentence);
            }
        }
    }

    return $questions;
}

function isFact($sentence) {
    // Basic check to determine if the sentence contains a factual statement
    // (you can enhance this by adding more complex logic like named entity recognition, etc.)
    return preg_match('/\b(is|are|was|were|has|have|had|will)\b/', $sentence);
}

function isDefinition($sentence) {
    // Check if the sentence looks like a definition (for example, "X is defined as...")
    return preg_match('/\bis defined as\b/', $sentence);
}

function generateTrueFalseQuestion($sentence) {
    // Make a True/False question based on a factual statement
    return [
        'question' => "Is the following statement true? $sentence",
        'type' => 'true-false',
        'answer' => rand(0, 1) ? 'True' : 'False'
    ];
}

function generateFillInBlankQuestion($sentence) {
    // Find key terms in the sentence and create a fill-in-the-blank question
    $words = explode(' ', $sentence);
    $keyWord = $words[rand(1, count($words) - 2)]; // Choose a word in the middle of the sentence
    return [
        'question' => "Fill in the blank: " . str_replace($keyWord, '____', $sentence),
        'type' => 'fill-in-the-blank',
        'answer' => $keyWord
    ];
}

function generateMultipleChoiceQuestion($sentence) {
    // Create a multiple-choice question
    $options = ['a', 'b', 'c', 'd'];
    shuffle($options);
    return [
        'question' => "What is the meaning of the sentence? $sentence",
        'type' => 'multiple-choice',
        'options' => $options,
        'answer' => $options[0]  // Randomly choose the first option as the correct answer
    ];
}
