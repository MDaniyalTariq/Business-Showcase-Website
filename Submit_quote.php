<?php
// Establish database connection (replace placeholders with your actual DB credentials)
$servername = "localhost"; // Change this to your database server's address
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "ezzemdb"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data after sanitizing
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Prepare SQL statement and execute
$sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
if ($conn->query($sql) === TRUE) {
    $response = array("success" => true, "message" => "Your request is successfully submitted!");
} else {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
