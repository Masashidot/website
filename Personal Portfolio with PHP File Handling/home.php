<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masashi site</title>
    <!-- Link to external CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header Section -->
    <header class="main-header">
        <div class="header-container">
            <h1>Welcome to my porfolio</h1>
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
    <div class="background-container">
        <style>
        body {
            margin: 0;
            background-image: url('japan-background-digital-art.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }
    </style>
    </div>
    <div class="textfonts">
    <?php
        // Reading content from 'homepage.txt'
        $filename = 'homepage.txt';
        if (file_exists($filename)) {
            $file = fopen($filename, "r"); // Open file for reading
            $content = fread($file, filesize($filename)); // Read file content
            fclose($file); // Close the file
            echo nl2br($content); // Display content with line breaks
        } else {
            echo "Content not available.";
        }
        ?>
    </div>
        <section class="content">
            <div class="container">
            
            <h2 class="button-link"><a href="about me.php">About Me</a></h2>
            <h3 class="button-link"><a href="homepageedit.php">Edit</a></h3>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> My PHP Website. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
