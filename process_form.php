<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ezzemdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $businessArea = $_POST['business-area'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $postalCode = $_POST['postal-code'];
    $address = $_POST['address'];
    $itemCategory = $_POST['item-category'];
    $itemSubcategory = $_POST['item-subcategory'];
    $itemSize = $_POST['item-size'];
    $itemQuantity = $_POST['item-quantity'];
    $comments = $_POST['comments'];
    $paymentMethod = $_POST['payment-method'];
    $cardNumber = $_POST['card-number'];
    $expiryDate = $_POST['expiry-date'];
    $cvv = $_POST['cvv'];
    $paypalEmail = $_POST['paypal-email'];
    $paypalPassword = $_POST['paypal-password'];
    $fileUpload = $_POST['file-upload'];
    $deliveryOption = $_POST['delivery-option'];
    $totalAmount = $_POST['total-amount'];
    $deliveryAddress = $_POST['delivery-address'];
    $estimatedDelivery = $_POST['estimated-delivery'];
    $additionalRequests = $_POST['additional-requests'];
    $confirmOrder = $_POST['confirm-order'];

    if ($paymentMethod === 'credit-card') {
        $paypalEmail = null;
        $paypalPassword = null;
    } elseif ($paymentMethod === 'paypal') {
        $cardNumber = null;
        $expiryDate = null;
        $cvv = null;
    } else {
        echo "Invalid payment method selected. Please select either 'credit card' or 'paypal'.";
        exit();
    }

    $sql = "INSERT INTO orders (business_area, name, email, country, state, city, postal_code, address, item_category, item_subcategory, item_size, item_quantity, comments, payment_method, card_number, expiry_date, cvv, paypal_email, paypal_password, file_upload, delivery_option, total_amount, delivery_address, estimated_delivery, additional_requests, confirm_order) 
            VALUES ('$businessArea', '$name', '$email', '$country', '$state', '$city', '$postalCode', '$address', '$itemCategory', '$itemSubcategory', '$itemSize', '$itemQuantity', '$comments', '$paymentMethod', '$cardNumber', '$expiryDate', '$cvv', '$paypalEmail', '$paypalPassword', '$fileUpload', '$deliveryOption', '$totalAmount', '$deliveryAddress', '$estimatedDelivery', '$additionalRequests', '$confirmOrder')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
