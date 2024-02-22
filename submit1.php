<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Basic validation (you can add more complex validation)
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        // If any field is empty, return an error message
        echo "Please fill in all fields.";
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    // Send an email notification (example using PHP's mail function)
    $to = "m.daniyaltariq9063@gmail.com"; // Replace with your email address
    $subject = "New Contact Form Submission";
    $email_body = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message";
    $headers = "From: $email";

    // Uncomment the line below to send the email
    // mail($to, $subject, $email_body, $headers);

    // If all operations were successful
    echo "Form submitted successfully!";
} else {
    // If someone tries to access this script directly without a POST request
    echo "Error: Invalid request";
}
?>
