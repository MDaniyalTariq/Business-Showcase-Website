<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Certificates</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="script.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <link rel="stylesheet" href="styles.css">
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap">
  <link rel="stylesheet" href="orderform.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="Certificates.css">
</head>

<style>
.main {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 0;
    }

    .certificate-details {
      width: calc(100% - 240px);
      max-width: 800px;
      margin: 20px;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    p {
      line-height: 1.6;
    }

    .aside {
      width: 240px;
      padding: 20px;
      background-color: #f4f4f4;
      order: -1;
    }

    .side-links ul {
      list-style: none;
      padding: 0;
    }

    .side-links ul li {
      margin-bottom: 10px;
    }

    .side-links ul li a {
      text-decoration: none;
      color: #333;
      display: block;
    }

    .side-links ul li a:hover {
      text-decoration: underline;
    }

    .back-link {
      text-decoration: none;
      color: #333;
      display: block;
      margin-top: 20px;
    }

    /* Responsive styles */
    @media screen and (max-width: 768px) {
      .main {
        flex-direction: column;
        align-items: center;
      }

      .certificate-details {
        width: calc(100% - 40px);
        margin: 20px 0;
      }

      .aside {
        width: calc(100% - 40px);
        order: 0;
      }
    }
    .menu-icon {
  display: none; /* Hide by default on larger screens */
}

/* Media query for mobile view */
@media screen and (max-width: 768px) {
  .menu-icon {
    display: block; /* Show on smaller screens */
    cursor: pointer;
  }

  .aside {
    display: none; /* Hide side-links by default on smaller screens */
  }

  .aside.open {
    display: block; /* Show side-links when menu is open */
  }
}
  </style>
<body>
    <div class="main">
    <div class="menu-icon">
  <i class="fas fa-bars"></i>
</div>

    <aside class="aside">
    <div class="side-links">
      <ul>
        <li><a href="certificate1.php?id=1">ISO 9001 Certification - Quality Management Standard</a></li>
        <li><a href="certificate1.php?id=2">ASTM Standards Compliance</a></li>
        <!-- Add similar links for other certificates -->
      </ul>
    </div>
    <a href="Certificates.html" class="back-link">
      <i class="fas fa-arrow-left"></i> Back to Certificates
    </a>
  </aside>
<script>
  $(document).ready(function() {
  $('.menu-icon').click(function() {
    $('.aside').toggleClass('open'); // Toggle the 'open' class on click
  });
});

</script>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ezzemdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $certificateId = $_GET['id'];

    $sql = "SELECT * FROM certificates WHERE id = $certificateId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='certificate-details'>";
            echo "<h1>" . $row["title"] . "</h1>";
            echo "<p >Issue Date:" . $row["issue_date"] . "</p>";
            echo "<p >Expiry Date:" . $row["expiry_date"] . "</p>";
            echo "<p >" . $row["description"] . "</p>";
            

            $imageData = $row["certificate_image"];

            if (isset($row["image_type"])) {
                $imageType = $row["image_type"];
                echo '<img src="data:' . $imageType . ';base64,' . base64_encode($imageData) . '" alt="Certificate Image">';
            } else {
                echo '<img src="error_image.png" alt="Error: Image not available">';
            }

            echo "</div>";
        }
    } else {
        echo "Certificate details not found.";
    }
} else {
    echo "Certificate ID not provided.";
}

$conn->close();
?>

    </div>

</body>
</html>
