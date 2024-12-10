<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectsFile = 'projects.json';
    $uploadsDir = 'uploads/';

    // Delete the projects file
    if (file_exists($projectsFile)) {
        unlink($projectsFile);
    }

    // Remove all files in the uploads directory
    if (is_dir($uploadsDir)) {
        $files = glob($uploadsDir . '*'); // Get all files in the directory
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file); // Delete the file
            }
        }
    }

    echo json_encode(['success' => true]);
    exit;
}

?>
