<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masashi site</title>
    <link rel="stylesheet" href="style.css">
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
    <style>
   
        form, .skills-display {
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 50%;
        }
        input, select, button {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .skills-display {
            padding: 20px;
        }
        .skill-category {
            margin-bottom: 20px;
        }
        .skill-category h3 {
            margin-bottom: 5px;
        }
        .skill-list {
            padding-left: 20px;
            list-style-type: circle;
        }
        .edit-skill {
            color: #007bff;
            cursor: pointer;
            margin-left: 10px;
        }
        .edit-skill:hover {
            text-decoration: underline;
        }
        
    </style>
</head>
<body>

<h1>Skills Section</h1>

<?php
$skillsFile = 'skills_data.txt';
$categories = ["Programming Languages", "Tools", "Soft Skills"];


$skills = [];
if (file_exists($skillsFile)) {
    $file = fopen($skillsFile, 'r');
    if ($file) {
        while (($line = fgets($file)) !== false) {
            list($category, $skill) = explode(":", trim($line), 2);
            $skills[$category][] = $skill;
        }
        fclose($file);
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = htmlspecialchars(trim($_POST['category']));
    $skill = htmlspecialchars(trim($_POST['skill']));

    // Validation
    if ($category && $skill) {
        $newEntry = "$category: $skill\n";
        $file = fopen($skillsFile, 'a');
        if ($file) {
            fwrite($file, $newEntry);
            fclose($file);
            echo "<p style='color: green;'>Skill added successfully!</p>";
            $skills[$category][] = $skill;
        } else {
            echo "<p style='color: red;'>Failed to save skill.</p>";
        }
    } else {
        echo "<p style='color: red;'>Both category and skill are required.</p>";
    }
}


if (isset($_GET['delete'])) {
    $deleteCategory = $_GET['category'];
    $deleteSkill = $_GET['skill'];

    $updatedSkills = [];
    foreach ($skills as $category => $skillsList) {
        foreach ($skillsList as $currentSkill) {
            if (!($category === $deleteCategory && $currentSkill === $deleteSkill)) {
                $updatedSkills[] = "$category: $currentSkill\n";
            }
        }
    }

    $file = fopen($skillsFile, 'w');
    if ($file) {
        foreach ($updatedSkills as $entry) {
            fwrite($file, $entry);
        }
        fclose($file);
        header("Location: " . strtok($_SERVER["REQUEST_URI"], '?')); // Reload page
        exit;
    } else {
        echo "<p style='color: red;'>Failed to delete skill.</p>";
    }
}
?>


<form action="" method="POST">
    <label for="category">Category:</label>
    <select id="category" name="category" required>
        <option value="">Select a category</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="skill">Skill:</label>
    <input type="text" id="skill" name="skill" placeholder="Enter skill" required>

    <button type="submit">Add Skill</button>
</form>


<div class="skills-display">
    <h2>Your Skills:</h2>
    <?php if (empty($skills)): ?>
        <p>No skills added yet.</p>
    <?php else: ?>
        <?php foreach ($skills as $category => $skillsList): ?>
            <div class="skill-category">
                <h3><?= htmlspecialchars($category) ?></h3>
                <ul class="skill-list">
                    <?php foreach ($skillsList as $skill): ?>
                        <li>
                            <?= htmlspecialchars($skill) ?>
                            <a href="?delete=true&category=<?= urlencode($category) ?>&skill=<?= urlencode($skill) ?>" class="edit-skill">Delete</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
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
