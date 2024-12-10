<?php
$skillsFile = 'skills.txt';

// Initialize skills array
$skills = [
    "Programming Languages" => [],
    "Tools" => [],
    "Soft Skills" => []
];

// Check if the file exists and read it
if (file_exists($skillsFile)) {
    $lines = file($skillsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        [$category, $skill] = explode(': ', $line);
        if (isset($skills[$category])) {
            $skills[$category][] = $skill;
        }
    }
}

echo json_encode(['success' => true, 'skills' => $skills]);
?>
