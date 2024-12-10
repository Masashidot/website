<?php
session_start();
if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
    unset($_SESSION['errors']);
}

if (isset($_GET['success'])) {
    echo "<p style='color: green;'>Profile updated successfully!</p>";
}
?>
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
    <section class="content">
    <div class="container">
    <div style="height: 100px;"></div>
    <a href="about me.php" class="button-link">Return</a>
</div>
    </div>
    </section>
    </main>
    <div style="height: 500px;"></div>
    <footer class="main-footer">
        <div class="container">
       

            
   
            <p>&copy; <?php echo date("Y"); ?> My PHP Website. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
