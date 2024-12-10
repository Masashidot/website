<?php
$skillsFile = 'skills.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file exists
    if (file_exists($skillsFile)) {
        // Clear the file content
        file_put_contents($skillsFile, '');
        echo json_encode(['success' => true, 'message' => 'Skills reset successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Skills file not found.']);
    }
    exit;
}
?>
