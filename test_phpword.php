<?php
require_once 'vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;

$phpWord = new PhpWord();
$section = $phpWord->addSection();
$section->addText('Hello, PhpWord!');

$fileName = 'test.docx';
$phpWord->save($fileName, 'Word2007');

echo "Word document created successfully: $fileName";
?>
