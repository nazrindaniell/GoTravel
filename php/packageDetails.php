<?php

session_start();
// Connect with the database
$isLoggedin = isset($_SESSION['id']);
require("../php/dbconnect.php");

// Check if there is a referrer URL
if(isset($_SERVER['HTTP_REFERER'])) {
    $referrer = $_SERVER['HTTP_REFERER'];
} else {
    // If no referrer URL is set, redirect to a default page
    $referrer = "index.php"; // Change this to the default page URL
}

// Get user ID from session
$userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;

// Function to retrieve membership plan by user ID from database
function getMembershipPlan($userId, $conn){
    // SQL query to select membership_plan from users table based on user ID
    $sql = "SELECT membership_plan FROM users WHERE id = ?";  
    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, $sql);    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $userId);
    // Execute the statement
    mysqli_stmt_execute($stmt); 
    // Get the result
    $result = $stmt->get_result(); 
    // Fetch the row
    $row = $result->fetch_assoc(); 
    // Check if row exists
    if ($row) {
        // Return the membership_plan value
        return $row['membership_plan'];
    } else {
        // Handle the case where user ID does not exist or membership_plan is not set
        return "did not find a user ID";
    }
}

// Initialize membership_plan variable
$membership_plan = "";

// Check if user ID exists in session
if(isset($_SESSION['id'])) {
    // Get user ID from session
    $userId = $_SESSION['id'];  
    // Call the function to retrieve membership_plan
    $membership_plan = getMembershipPlan($userId, $conn);
} 
else {
    //handle the error event
}

// Function to calculate membership discount
function calculateDiscount($membership_plan, $price){
    $discount = 0;
    if ($membership_plan == 'Silver plan'){
        $discount = 0.15; // 15% discount for Silver plan
    } 
    elseif ($membership_plan == 'Gold plan'){
        $discount = 0.20; // 20% discount for Gold plan
    }
    return $price * $discount; // Calculate the discount amount
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

// Calculate discounted price
$price = $packageDetails['price'];
$discount = calculateDiscount($membership_plan, $price);
$finalPrice = $price - $discount;
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
        $isLoggedin = isset($_SESSION['id']);
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
                    <div class="cost">
                        <div class="flex">
                            <h4>Cost</h4>
                            <h4>RM <?= $price ?></h4>
                        </div>
                        <?php if($isLoggedin): ?>
                        <div class="flex">
                            <h4>Membership</h4>
                            <h4>-RM <?= $discount?></h4>
                        </div>
                        <?php endif; ?>
                        <div class="flex">
                            <h4>Total</h4>
                            <h4>RM <?= $finalPrice ?></h4>
                        </div>
                    </div>
                    <div class="btn-container">
                        <?php if ($isLoggedin): ?>
                        <a href="https://buy.stripe.com/test_aEUdRm6Xm96J6XK3cj">Proceed Payment</a>
                        <?php else: ?>
                        <a href="../php/login.php">Proceed Payment</a>
                        <?php endif; ?>
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
