<?php
$projectsFile = 'projects.json';
if (file_exists($projectsFile)) {
    $projects = json_decode(file_get_contents($projectsFile), true);
    echo json_encode(['success' => true, 'projects' => $projects]);
} else {
    echo json_encode(['success' => true, 'projects' => []]);
}
?>
