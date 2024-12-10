<?php
$filename = "profile_data.txt";
$profileData = [];

if (file_exists($filename)) {
    $fileContent = file_get_contents($filename);
    // Split the content by lines
    $lines = explode(PHP_EOL, $fileContent);

    // Parse the content into key-value pairs
    foreach ($lines as $line) {
        if (strpos($line, ':') !== false) {
            list($key, $value) = explode(':', $line, 2);
            $profileData[trim($key)] = trim($value);
        }
    }
} else {
    echo "<p style='color: red;'>Error: Profile data file does not exist.</p>";
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
    <div class="background-container">
        <style>
        body {
            margin: 0;
            background-image: url('about2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100%;
        }
            label {
            font-weight: bold;
            margin-bottom: 5px;
            display: inline-block;
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

        /* Text Box (Single-line input) */
        input[type="text"] {
            width: 30%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease;
        }
        input[type="email"] {
            width: 30%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease;
        }
        input[type="date"] {
            width: 30%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease;

        }
        input[type="url"] {
            width: 30%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease;
        }
        input[type="tel"] {
            width: 30%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }
        input[type="email"]:focus {
            border-color: #007bff;
            outline: none;
        }
        input[type="date"]:focus {
            border-color: #007bff;
            outline: none;
        }
        input[type="url"]:focus {
            border-color: #007bff;
            outline: none;
        }
        input[type="tel"]:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Text Area (Multi-line input) */
        textarea {
            width: 30%;
            height: 100px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            resize: vertical; /* Allows user to resize vertically only */
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease;
        }

        textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Submit Button */
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
    </div>
    <form method="POST" action="update_profile.php">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required><br>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required><br>

    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="website">Website:</label>
    <input type="url" id="website" name="website"><br>

    <label for="birthday">Birthdate:</label>
    <input type="date" id="birthday" name="birthday"><br>

    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required><br>

    <label for="city">City:</label>
    <input type="text" id="city" name="city"><br>

    <label for="degree">Degree:</label>
    <input type="text" id="degree" name="degree"><br>

    <label for="freelance">Freelance:</label>
    <select id="freelance" name="freelance">
        <option value="Available">Available</option>
        <option value="Unavailable">Unavailable</option>
    </select><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description"></textarea><br><br>

    <button type="submit">Update</button>
    <div class="about-section">
    <h2>About</h2>
    <p><strong>Name:</strong> <?= $profileData['Name'] ?? 'Not Available'; ?></p>
    <p><strong>Email:</strong> <?= $profileData['Email'] ?? 'Not Available'; ?></p>
    <p><strong>Website:</strong> <?= $profileData['Website'] ?? 'Not Available'; ?></p>
    <p><strong>Birthday:</strong> <?= $profileData['Birthday'] ?? 'Not Available'; ?></p>
    <p><strong>Phone:</strong> <?= $profileData['Phone'] ?? 'Not Available'; ?></p>
    <p><strong>City:</strong> <?= $profileData['City'] ?? 'Not Available'; ?></p>
    <p><strong>Degree:</strong> <?= $profileData['Degree'] ?? 'Not Available'; ?></p>
    <p><strong>Freelance:</strong> <?= $profileData['Freelance'] ?? 'Not Available'; ?></p>
    <p><strong>Description:</strong> <?= $profileData['Description'] ?? 'Not Available'; ?></p>
</div>

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
