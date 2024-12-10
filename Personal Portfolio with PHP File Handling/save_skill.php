<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $category = $input['category'] ?? '';
    $skill = $input['skill'] ?? '';

    if (!$category || !$skill) {
        echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
        exit;
    }

    $skillsFile = 'skills.txt';

    $entry = "$category: $skill\n";

    file_put_contents($skillsFile, $entry, FILE_APPEND);

    echo json_encode(['success' => true]);
}
?>
