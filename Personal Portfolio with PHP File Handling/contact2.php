<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    $errors = [];

    // Validate input
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    // If no errors, save to files
    if (empty($errors)) {
        $currentDate = date('Y-m-d H:i:s');
        
        // Format data
        $data = "Name: $name\nEmail: $email\nMessage: $message\nDate: $currentDate\n\n";

        // Save the most recent submission (overwrites the file)
        file_put_contents('submissions.txt', $data);

        // Append all submissions to another file
        file_put_contents('all_submissions.txt', $data, FILE_APPEND);

        // Redirect back with success message
        header("Location: contact.php?success=1");
        exit;
    } else {
        // Redirect back with error messages
        header("Location: contact.php?error=" . urlencode(implode(", ", $errors)));
        exit;
    }
}
?>
