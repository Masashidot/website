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
         body {
            margin: 0;
            background-image: url('about.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: fit-content;
        }
   
        form, .display-section {
            
            width: 50%;
            margin: 0 auto;
            padding: 80px;
            background-color: #f9f9f9;
            border: 10px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            
            
        }
        input, textarea, select, button {
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
        h2 {
            margin-top: 0;
        }
        .display-section p {
            margin: 5px 0;
        }
    </style>
</head>

<h1>About Me</h1>

<?php
$dataFile = 'aboutme_data.txt';

$existingData = ["", "", "", "", "", ""]; 

if (file_exists($dataFile)) {
    $file = fopen($dataFile, 'r');
    if ($file) {
        $content = fread($file, filesize($dataFile));
        fclose($file);
        $existingData = array_map('trim', explode("\n", $content));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = htmlspecialchars(trim($_POST['first_name']));
    $lastName = htmlspecialchars(trim($_POST['last_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $description = htmlspecialchars(trim($_POST['description']));


    if ($firstName && $lastName && $email && $phone && $gender && $description) {
        $data = "$firstName\n$lastName\n$email\n$phone\n$gender\n$description\n";
        $file = fopen($dataFile, 'w');
        if ($file) {
            fwrite($file, $data);
            fclose($file);
            $existingData = [$firstName, $lastName, $email, $phone, $gender, $description];
            echo "<p style='color: green;'>Information updated successfully!</p>";
        } else {
            echo "<p style='color: red;'>Failed to save data.</p>";
        }
    } else {
        echo "<p style='color: red;'>All fields are required.</p>";
    }
}
?>
<div class="display-section">
    <h2>Your Information:</h2>
    <p><strong>First Name:</strong> <?= htmlspecialchars($existingData[0]) ?></p>
    <p><strong>Last Name:</strong> <?= htmlspecialchars($existingData[1]) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($existingData[2]) ?></p>
    <p><strong>Phone:</strong> <?= htmlspecialchars($existingData[3]) ?></p>
    <p><strong>Gender:</strong> <?= htmlspecialchars($existingData[4]) ?></p>
    <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($existingData[5])) ?></p>
</div>

<form action="" method="POST">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($existingData[0]) ?>" required>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($existingData[1]) ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($existingData[2]) ?>" required>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($existingData[3]) ?>" required>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="" <?= $existingData[4] === "" ? "selected" : "" ?>>Select</option>
        <option value="Male" <?= $existingData[4] === "Male" ? "selected" : "" ?>>Male</option>
        <option value="Female" <?= $existingData[4] === "Female" ? "selected" : "" ?>>Female</option>
        <option value="Other" <?= $existingData[4] === "Other" ? "selected" : "" ?>>Other</option>
    </select>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" required><?= htmlspecialchars($existingData[5]) ?></textarea>

    <button type="submit">Save Information</button>
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
