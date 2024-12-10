<?php
$filename = 'homepage.txt';
$errorMessage = ""; // Variable to store error messages

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newContent = trim($_POST['content']); // Trim to remove extra spaces
    
    // Check if content is empty
    if (empty($newContent)) {
        $errorMessage = "Error: Content cannot be empty."; // Set error message
    } else {
        // Truncate the file and write new content
        $file = fopen($filename, "w"); // Open file in write mode, truncates it
        if ($file) {
            fwrite($file, $newContent); // Write the updated content
            fclose($file); // Close the file
            echo "<p style='color: green;'>Content updated successfully!</p>";
        } else {
            $errorMessage = "Error: Could not open the file for writing."; // Set error message
        }
    }
}

// Read the current content for display
$currentContent = "";
if (file_exists($filename) && filesize($filename) > 0) {
    $file = fopen($filename, "r"); // Open file for reading
    $currentContent = fread($file, filesize($filename));
    fclose($file);
} elseif (empty($currentContent)) {
    $currentContent = "Default content goes here."; // Fallback content
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to my porfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header Section -->
    <header class="main-header">
        <div class="header-container">
            <button class="toggle-btn" onclick="toggleNavbar()">☰ Menu</button>
            <!-- Navbar -->
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="about me.php">About Me</a></li>
                    <li><a href="projects.php">Projects</a></li>
                    <li><a href="skill.php">Skills</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
    

    <?php if (!empty($errorMessage)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($errorMessage); ?></p> <!-- Display error message -->
    <?php endif; ?>

    <form method="POST">
        <textarea name="content" rows="10" cols="50"><?php echo htmlspecialchars($currentContent); ?></textarea><br>
        <button type="submit" class="button submit-button">Save Changes</button>
        <a href="home.php" class="button home-button">Back Home</a>
        
    </form>

    </main>
    <footer class="main-footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> My PHP Website. All Rights Reserved.</p>
        </div>
    
    </footer>

    <script src="script.js"></script>
</body>
</html>

