<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masashi site - Contact</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            
            background-color: #f4f4f4;
            margin: 0;
            
            background-image: url('contact.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: fit-content;
        }
        
     
        .toggle-btn {
            background-color: transparent;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            cursor: pointer;
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        form {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .submissions {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-top: 20px;
            margin-left: 25%;
            margin-right: 25%;
        }
        .submission {
            margin-bottom: 10px;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <h1>Welcome to my portfolio</h1>
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
    <h1>Contact Us</h1>

<?php
$contactFile = 'contact_submissions.txt';
$allContactsFile = 'all_contact_submissions.txt';
$errors = [];
$successMessage = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));


    if (!$name) {
        $errors[] = "Name is required.";
    }
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email is required.";
    }
    if (!$message) {
        $errors[] = "Message cannot be empty.";
    }

    if (empty($errors)) {
        $entry = "Name: $name\nEmail: $email\nMessage: $message\n---\n";

        $allFile = fopen($allContactsFile, 'a');
        if ($allFile) {
            fwrite($allFile, $entry);
            fclose($allFile);
        }

      
        $file = fopen($contactFile, 'w');
        if ($file) {
            fwrite($file, $entry);
            fclose($file);
            $successMessage = "Your message has been submitted successfully!";
        } else {
            $errors[] = "Failed to save your message. Please try again.";
        }
    }
}
?>


<div class="form-container">
    <form action="" method="POST">
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($successMessage): ?>
            <div class="success">
                <p><?= htmlspecialchars($successMessage) ?></p>
            </div>
        <?php endif; ?>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Your Name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Your Email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" placeholder="Your Message" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>

        <button type="submit">Submit</button>
    </form>
</div>


<div class="submissions">
    <h2>Most Recent Submission</h2>
    <?php
    if (file_exists($contactFile)) {
        $file = fopen($contactFile, 'r');
        if ($file) {
            $submission = "";
            while (($line = fgets($file)) !== false) {
                if (trim($line) === "---") {
                    break;
                }
                $submission .= htmlspecialchars($line) . "<br>";
            }
            fclose($file);
            echo $submission;
        } else {
            echo "<p>Could not load the most recent submission.</p>";
        }
    } else {
        echo "<p>No recent submissions yet.</p>";
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
