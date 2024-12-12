<?php
session_start();
$projectsFile = 'projects.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_project']) && !isset($_SESSION['submitted'])) {
    $_SESSION['submitted'] = true;

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $skills = trim($_POST['skills']);
    $image = $_FILES['image'];

    if ($title && $description && $skills && $image['error'] === 0) {
        $imagePath = 'uploads/' . basename($image['name']);
        if (!file_exists('uploads')) {
            mkdir('uploads');
        }
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            $entry = "$title|$description|$skills|$imagePath\n";

            $file = fopen($projectsFile, 'a');
            if ($file) {
                fwrite($file, $entry);
                fclose($file);
                echo '<p class="success">Project added successfully!</p>';
                unset($_SESSION['submitted']);
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            } else {
                echo '<p class="error">Error: Could not write to file.</p>';
                unset($_SESSION['submitted']);
            }
        } else {
            echo '<p class="error">Error: Failed to upload image.</p>';
            unset($_SESSION['submitted']);
        }
    } else {
        echo '<p class="error">Error: All fields are required.</p>';
        unset($_SESSION['submitted']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_project'])) {
    $deleteLine = trim($_POST['delete_project']);

    if (file_exists($projectsFile)) {
        $lines = file($projectsFile, FILE_IGNORE_NEW_LINES);
        $updatedLines = array_filter($lines, function ($line) use ($deleteLine) {
            return trim($line) !== $deleteLine;
        });

        $file = fopen($projectsFile, 'w');
        if ($file) {
            foreach ($updatedLines as $line) {
                fwrite($file, $line . "\n");
            }
            fclose($file);
            echo '<p class="success">Project deleted successfully!</p>';
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo '<p class="error">Error: Could not update file.</p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masashi site</title>
    <link rel="stylesheet" href="style.css">
    <style>
     

        form {
            max-width: 500px;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 0 auto;
        }

        input, textarea, button {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .project {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .project img {
            max-width: 300px;
            height: auto;
            margin-top: 10px;
        }

        .project-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            gap: 20px;
            justify-content: center;
            align-items: center
        }

    </style>
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <h1>Welcome to my porfolio</h1>
            <button class="toggle-btn" onclick="toggleNavbar()">☰ Menu</button>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about_me.php">About Me</a></li>
                    <li><a href="project.php">Projects</a></li>
                    <li><a href="skill.php">Skills</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
<main>
    
    <h1>Project Showcase</h1>

    <form action="project.php" method="POST" enctype="multipart/form-data">
        <label for="title">Project Title:</label>
        <input type="text" id="title" name="title" placeholder="Enter project title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" placeholder="Enter project description" required></textarea>

        <label for="skills">Associated Skills (comma-separated):</label>
        <input type="text" id="skills" name="skills" placeholder="e.g., PHP, JavaScript" required>

        <label for="image">Project Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <button type="submit" name="add_project">Add Project</button>
    </form>


    <h2>Current Projects</h2>
    <div class="project-container">
        <?php
        $projectsFile = 'projects.txt';
        if (file_exists($projectsFile)) {
            $file = fopen($projectsFile, 'r');
            if ($file) {
                while (($line = fgets($file)) !== false) {
                    list($title, $description, $skills, $imagePath) = explode('|', trim($line));
                    echo '<div class="project">';
                    echo '<h3>' . htmlspecialchars($title) . '</h3>';
                    echo '<p>' . htmlspecialchars($description) . '</p>';
                    echo '<p><strong>Skills:</strong> ' . htmlspecialchars($skills) . '</p>';
                    echo '<img src="' . htmlspecialchars($imagePath) . '" alt="' . htmlspecialchars($title) . '">';
                    echo '<form action="project.php" method="POST" style="margin-top: 10px;">';
                    echo '<input type="hidden" name="delete_project" value="' . htmlspecialchars($line) . '">';
                    echo '<button type="submit">Delete Project</button>';
                    echo '</form>';
                    echo '</div>';
                }
                fclose($file);
            }
        } else {
            echo '<p>No projects available.</p>';
        }
        ?>
    </div>
    </main>
    <footer class="main-footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> My PHP Website. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
