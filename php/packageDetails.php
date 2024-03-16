<?php
//connect with the database
require("../php/dbconnect.php");

// Check if there is a referrer URL
if(isset($_SERVER['HTTP_REFERER'])) {
    $referrer = $_SERVER['HTTP_REFERER'];
} else {
    // If no referrer URL is set, redirect to a default page
    $referrer = "index.php"; // Change this to the default page URL
}

// Function to retrieve package details by ID
function getPackageDetails($packageId, $conn){
    $sql = "SELECT * FROM packages WHERE package_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $packageId);
    mysqli_stmt_execute($stmt);
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Function to retrieve images for a specific package by ID
function getPackageImages($packageId, $conn){
    $sql = "SELECT * FROM packages_image WHERE package_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $packageId);
    mysqli_stmt_execute($stmt);
    $result = $stmt->get_result();
    $images = array();
    while($row = $result->fetch_assoc()){
        $images[] = $row;
    }
    return $images;
}

// Get package ID from URL parameter
$packageId = isset($_GET['package_id']) ? $_GET['package_id'] : null;

// Retrieve package details and images
if($packageId){
    $packageDetails = getPackageDetails($packageId, $conn);
    $packageImages = getPackageImages($packageId, $conn);
} else {
    // Redirect to error page or handle accordingly if package ID is not provided
    header("Location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/packageDetails.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Package Details</title>
</head>
<body>
    <?php
        include_once "../includes/navbar.php";
    ?>
     <header>
        <div class="title-header">
            <a href="<?php echo htmlspecialchars($referrer); ?>"><i class='bx bx-chevron-left bx-lg'></i></a>
            <h2><?= $packageDetails['package_name'] ?></h2>
        </div>
        <div class="grid-images">
            <?php foreach ($packageImages as $image): ?>
                <img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
            <?php endforeach; ?>
        </div>
    </header>
     <section>
        <div class="grid-content">
            <div class="left-grid">
                <div class="container">
                    <div class="header">
                        <h3>Everything you need when visiting <?= $packageDetails['package_name'] ?>.</h3>
                        <p>"Explore <?=$packageDetails['package_name']?>'s top sights with our expert guide, enjoying stunning views worry-free."</p>
                    </div>
                    <div class="trip-details">
                        <h4>Trip details</h4>
                        <div class="desc">
                            <div class="round">
                                <i class='bx bx-calendar bx-sm'></i>
                            </div>
                            <h3><?=$packageDetails['duration']?></h3>
                        </div>
                        <div class="desc">
                            <div class="round">
                                <i class='bx bx-map bx-sm' ></i>
                            </div>
                            <h3><?=$packageDetails['location']?></h3>
                        </div>
                        <div class="desc">
                            <div class="round">
                                <i class='bx bx-star bx-sm' ></i>
                            </div>
                            <h3><?=$packageDetails['rating']?> (<?=$packageDetails['reviews']?> Reviews)</h3>
                        </div>
                    </div>
                    <div class="offers">
                        <h4>What this package offers</h4>
                        <div class="desc">
                            <div class="round">
                                <i class='bx bx-check bx-sm'></i>
                            </div>
                            <h3>Accommodation</h3>
                        </div>
                        <div class="desc">
                            <div class="round">
                                <i class='bx bx-check bx-sm'></i>
                            </div>
                            <h3>Guide</h3>
                        </div>
                        <div class="desc">
                            <div class="round">
                                <i class='bx bx-check bx-sm'></i>
                            </div>
                            <h3>Transport</h3>
                        </div>
                        <div class="desc">
                            <div class="round">
                                <i class='bx bx-check bx-sm'></i>
                            </div>
                            <h3>Meals</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-grid">
                <div class="container">
                    <div class="payment-details">
                        <h4>Payment Details</h4>
                        <h3>RM <?= $packageDetails['price'] ?><span>/person</span></h3>
                    </div>
                    <div class="quantity">
                        <h4>Pax quantity</h4>
                        
                    </div>
                </div>
            </div>
        </div>
     </section>
     
     <?php 
        include_once "../includes/footer.php";
     ?>
</body>
</html>