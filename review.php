<?php
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "ezzemdb"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check the request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle POST request for submitting a review
    $reviewerName = $_POST["reviewerName"];
    $reviewerEmail = $_POST["reviewerEmail"];
    $reviewContent = $_POST["reviewContent"];
    $rating = $_POST["rating"];

    $sql = "INSERT INTO reviews (reviewerName, reviewerEmail, reviewContent, rating)
    VALUES ('$reviewerName', '$reviewerEmail', '$reviewContent', '$rating')";

    if ($conn->query($sql) === TRUE) {
        echo "Review submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Handle GET request to fetch all reviews with Gravatar image URLs
    $sql = "SELECT reviewerName, reviewerEmail, reviewContent, rating FROM reviews";
    $result = $conn->query($sql);

    $reviews = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $email = $row['reviewerEmail'];
            $gravatarURL = getGravatarURL($email, 200); // Function to get Gravatar URL (as previously defined)

            $reviews[] = array(
                'reviewerName' => $row['reviewerName'],
                'reviewContent' => $row['reviewContent'],
                'rating' => $row['rating'],
                'gravatarURL' => $gravatarURL
            );
        }
        // Output reviews in JSON format
        echo json_encode($reviews);
    } else {
        echo "No reviews found";
    }
}

$conn->close();

// Function to get Gravatar URL
function getGravatarURL($email, $size = 80) {
    $emailHash = md5(strtolower(trim($email)));
    return "https://www.gravatar.com/avatar/{$emailHash}?s={$size}";
}
?>