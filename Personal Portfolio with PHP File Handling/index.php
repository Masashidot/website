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
        <style>
        body {
            margin: 0;
            background-image: url('japan-background-digital-art.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: fit-content;
        }
        form {
            width: 50%;
            margin: 0 auto;
            padding: 80px;
            background-color: #f9f9f9;
            border: 10px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            
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

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }

        .content {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f4f4f4;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .content img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 3px solid #007bff;
        }
    </style>
</head>

    <h1>Welcome to My Home Page</h1>

    <?php
    $dataFile = 'intro.txt';
    $uploadDir = 'uploads/';
    $error = '';
    $success = '';

   
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $introduction = trim($_POST['introduction']);
        $tagline = trim($_POST['tagline']);
        $photo = $_FILES['photo'];

        if (empty($introduction) || empty($tagline)) {
            $error = 'Introduction and tagline are required.';
        } elseif ($photo['error'] === UPLOAD_ERR_OK) {
            $photoPath = $uploadDir . basename($photo['name']);
            if (move_uploaded_file($photo['tmp_name'], $photoPath)) {
               
                $file = fopen($dataFile, 'w');
                fwrite($file, $introduction . "\n");
                fwrite($file, $tagline . "\n");
                fwrite($file, $photoPath);
                fclose($file);
                $success = 'Information updated successfully!';
            } else {
                $error = 'Failed to upload the photo.';
            }
        } else {
            $error = 'Please upload a valid photo.';
        }
    }

   
    $introduction = '';
    $tagline = '';
    $photoPath = '';
    if (file_exists($dataFile)) {
        $file = fopen($dataFile, 'r');
        $introduction = fgets($file);
        $tagline = fgets($file);
        $photoPath = fgets($file);
        fclose($file);
    }
    ?>

   
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

  
    <div class="content">
        <?php if ($photoPath): ?>
            <img src="<?= htmlspecialchars($photoPath) ?>" alt="Profile Photo">
        <?php else: ?>
            <img src="default-profile.png" alt="Default Photo">
        <?php endif; ?>
        <h3><?= htmlspecialchars($introduction) ?: 'Your introduction will appear here.' ?></h3>
        <p><?= htmlspecialchars($tagline) ?: 'Your tagline will appear here.' ?></p>
    </div>

   
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="introduction">Introduction:</label>
        <textarea id="introduction" name="introduction" rows="4" required><?= htmlspecialchars($introduction) ?></textarea>

        <label for="tagline">Tagline:</label>
        <input type="text" id="tagline" name="tagline" value="<?= htmlspecialchars($tagline) ?>" required>

        <label for="photo">Upload Profile Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*">

        <button type="submit">Update Information</button>
    </form>
    <footer class="main-footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> My PHP Website. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
