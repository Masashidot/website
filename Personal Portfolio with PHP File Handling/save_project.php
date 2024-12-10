<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? null;
    $description = $_POST['description'] ?? null;
    $skills = json_decode($_POST['skills'] ?? '[]', true);
    $image = $_FILES['image'] ?? null;

    // Error handling
    if (!$title || !$description || empty($skills) || !$image) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Save image to server
    $uploadsDir = 'uploads/';
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0777, true);
    }

    $imagePath = $uploadsDir . basename($image['name']);
    if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
        echo json_encode(['success' => false, 'message' => 'Failed to upload image.']);
        exit;
    }

    // Save project data to a file
    $projectData = [
        'title' => $title,
        'description' => $description,
        'skills' => $skills,
        'imageUrl' => $imagePath
    ];
    $projectsFile = 'projects.json';

    $existingProjects = file_exists($projectsFile) ? json_decode(file_get_contents($projectsFile), true) : [];
    $existingProjects[] = $projectData;

    file_put_contents($projectsFile, json_encode($existingProjects));

    echo json_encode(['success' => true, 'project' => $projectData]);
}
?>
