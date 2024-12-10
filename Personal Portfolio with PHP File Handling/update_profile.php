

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize inputs
    $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $website = filter_input(INPUT_POST, 'website', FILTER_VALIDATE_URL);
    $birthday = filter_input(INPUT_POST, 'birthday', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $degree = filter_input(INPUT_POST, 'degree', FILTER_SANITIZE_STRING);
    $freelance = filter_input(INPUT_POST, 'freelance', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

    // Error handling
    $errors = [];
    if (!$firstName || !$lastName) {
        $errors[] = "First and last names are required.";
    }
    if (!$email) {
        $errors[] = "A valid email address is required.";
    }
    if (!$phone || strlen($phone) != 10) {
        $errors[] = "Phone number must be 10 digits.";
    }

    // If there are errors, redirect back with error messages
    if (!empty($errors)) {
        session_start();
        $_SESSION['errors'] = $errors;
        header("Location: edit_form.php");
        exit;
    }

    // Save data to a text file or database
    $filename = "profile_data.txt";
    $content = "
    Name: $firstName $lastName
    Email: $email
    Website: $website
    Birthday: $birthday
    Phone: $phone
    City: $city
    Degree: $degree
    Freelance: $freelance
    Description: $description
    ";
    if (file_put_contents($filename, $content, LOCK_EX) === false) {
        die("Error: Could not save the profile data.");
    }
   
    // Redirect with success
    header("Location: edit_form.php?success=1");
    exit;
}
?>

