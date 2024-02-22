<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your actual username
$password = ""; // Replace with your actual password
$dbname = "ezzemdb"; // Replace with your actual database name

// Establishing connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form data submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        // Send email using MailHog
        ini_set("SMTP", "localhost");
        ini_set("smtp_port", "1025");

        $to = "m.daniyaltariq9063@gmail.com"; // Replace with your recipient's email address
        $subject = "New Contact Form Submission";
        $email_message = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message";
        $headers = "From: $email"; // Replace with sender's email

        // Sending email
        mail($to, $subject, $email_message, $headers);

        echo "Your message has been submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Closing the database connection
$conn->close();
?>
