<?php
require_once 'vendor/autoload.php'; // Composer autoload

function extractTextFromFile($filePath) {
    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $text = '';

    try {
        if ($fileExtension === 'pdf') {
            // Use PDFParser for PDF files
            $parser = new \Smalot\PdfParser\Parser();
            $pdf = $parser->parseFile($filePath);
            $text = $pdf->getText();
        } elseif ($fileExtension === 'docx') {
            // Use PhpWord for DOCX files
            $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if (method_exists($element, 'getText')) {
                        $text .= $element->getText() . " ";
                    }
                }
            }
        } elseif ($fileExtension === 'pptx') {
            // Use PhpPresentation for PPTX files
            $phpPresentation = \PhpOffice\PhpPresentation\IOFactory::load($filePath);
            foreach ($phpPresentation->getAllSlides() as $slide) {
                foreach ($slide->getShapeCollection() as $shape) {
                    if ($shape instanceof \PhpOffice\PhpPresentation\Shape\RichText) {
                        foreach ($shape->getParagraphs() as $paragraph) {
                            foreach ($paragraph->getRichTextElements() as $element) {
                                $text .= $element->getText() . " ";
                            }
                        }
                    }
                }
            }
        } else {
            throw new Exception("Unsupported file type: $fileExtension");
        }
    } catch (Exception $e) {
        // Handle exceptions and return an error message
        return "Error processing file: " . $e->getMessage();
    }

    return trim($text);
}
?>
