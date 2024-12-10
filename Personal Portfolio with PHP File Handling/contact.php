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

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
    
        form {
        max-width: 500px;
        margin: 0 auto; /* Centers the form horizontally */
        padding: 20px;
        background-color: #fff; /* Optional: Adds a background for better visibility */
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional: Adds a shadow for a polished look */
        }

        input, textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            font-size: 14px;
        }
        .success {
            color: green;
            font-size: 14px;
        }
        .recent-entry {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Contact Us</h1>
    <form action="contact2.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>

        <button type="submit">Submit</button>
    </form>

    <div class="recent-entry">
        <h3>Most Recent Submission:</h3>
        <p>
            <?php 
                // Display the most recent entry from the file
                if (file_exists('submissions.txt')) {
                    $recentEntry = file_get_contents('submissions.txt');
                    echo nl2br(htmlspecialchars($recentEntry));
                } else {
                    echo "No submissions yet.";
                }
            ?>
        </p>
    </div>

    

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
