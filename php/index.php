<?php
//connect with the database
require("../php/dbconnect.php");

// Function to retrieve all packages with their associated images from the database
function getAllPackagesWithImages($conn){
    $sql = "SELECT p.*, i.image_path, i.alt_text FROM packages p LEFT JOIN packages_image i ON p.package_id = i.package_id";
    $result = mysqli_query($conn, $sql);
    $packages = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $packageId = $row['package_id'];
        if (!isset($packages[$packageId])) {
            // Initialize package array
            $packages[$packageId] = array(
                'package_id' => $packageId,
                'package_name' => $row['package_name'],
                'rating' => $row['rating'],
                'reviews' => $row['reviews'],
                'location' => $row['location'],
                'duration' => $row['duration'],
                'price' => $row['price'],
                'images' => array()
            );
        }
        // Add image to package
        if ($row['image_path']) {
            $packages[$packageId]['images'][] = array(
                'image_path' => $row['image_path'],
                'alt_text' => $row['alt_text']
            );
        }
    }
    return $packages;
}

// Retrieve all packages with their associated images from the database
$packages = getAllPackagesWithImages($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet" href="../css/index.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Home</title>
</head>
<body>
    <?php
        session_start();
        require("../php/dbconnect.php");
        include_once "../includes/navbar.php";
    ?>

    <!-- header section -->
    <header>
        <div class="header-img">
            <img src="https://images.pexels.com/photos/4275885/pexels-photo-4275885.jpeg?" alt="background img">
        </div>
        <div class="header-container">
            <h1>Explore the World's <br>Wonders</h1>
            <p>Your gateway to global exploration with GoTravel.</p>
            <div class="section-btn">
                <a href="../php/about.php">Start exploring</a>
            </div>
        </div>
        <div class="header-additional">
            <div class="text">
                <h4>National Route 40</h4>
                <p>Argentina</p>
            </div> 
            <div class="bg">
                <img src="https://images.pexels.com/photos/4275885/pexels-photo-4275885.jpeg?" alt="img">
            </div>
        </div>
        <div class="header-social">
            <a href="#"><i class='bx bxl-instagram-alt bx-sm'></i></a>
            <a href="#"><i class='bx bxl-twitter bx-sm'></i></a>
            <a href="#"><i class='bx bxl-facebook-circle bx-sm'></i></a>
        </div>
    </header>

    <!-- service section !-->
    <section>
        <div class="service-container">
            <h2>Top values for everyone</h2>
            <p>We provide a wide range of services to our customers</p>
        </div>
        <div class="service-type">
            <div class="list">
                <div class="round"><i class='bx bxs-id-card bx-sm'></i></div>
                <h4>Expert guidace</h4>
                <p>Get insider tips for<br> your travel</p>
            </div>
            <div class="list">
                <div class="round"><i class='bx bxs-discount bx-sm'></i></div>
                <h4>Exclusive deals</h4>
                <p>Enjoy member-only<br> discounts</p>
            </div>
            <div class="list">
                <div class="round"><i class='bx bxs-lock bx-sm'></i></div>
                <h4>Expert guidace</h4>
                <p>Secure bookings,<br> worry free</p>
            </div>
            <div class="list">
                <div class="round"><i class='bx bxs-plane-alt bx-sm'></i></div>
                <h4>Expert guidace</h4>
                <p>Plan and book easily,<br> all in one place</p>
            </div>
        </div>
    </section>

    <!--trip teaser section -->
    <section>
        <div class="item-container">
            <h2>Select your trip</h2>
            <div class="item-btn">
                <a href="../php/package.php">See more</a>
            </div>
        </div>
        <div class="item-list">
            <?php foreach ($packages as $package): ?>
                <a href="packageDetails.php?package_id=<?= $package['package_id'] ?>" class="card-link">
                    <div class="card">
                        <?php if(!empty($package['images'])): ?>
                            <div class="images">
                                <img src="<?= $package['images'][0]['image_path'] ?>" alt="<?= $package['images'][0]['alt_text'] ?>">
                            </div>
                        <?php endif; ?>
                        <div class="card-desc">
                            <h4><?= $package['package_name'] ?></h4>
                            <div class="desc">
                                <i class='bx bx-star bx-sm'></i>
                                <p><?= $package['rating'] ?> (<?= $package['reviews'] ?> Reviews)</p>
                            </div>
                            <div class="desc">
                                <i class='bx bx-map bx-sm'></i>
                                <p><?= $package['location'] ?></p>
                            </div>
                            <div class="desc">
                                <i class='bx bx-calendar bx-sm'></i>
                                <p><?= $package['duration'] ?></p>
                            </div>
                            <div class="price">
                                <h3>RM <?= $package['price'] ?></h3>
                                <p>/person</p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- membership section -->
    <section>
        <div class="membership-img">
            <img src="https://images.pexels.com/photos/571169/pexels-photo-571169.jpeg?" alt="membership img">
        </div>
        <div class="membership-container">
            <h2>Travel with membership benefits</h2>
            <p>Join our community of travelers and enjoy exclusive perks with our  membership <br>program. Whether you're a seasoned explorer or embarking on  your first adventure, <br>becoming a member of Go Travel Sdn Bhd opens the  door to a world of possibilities.</p>
            <div class="membership-btn">
                <a href="../php/membership.php">Learn more</a>
            </div>
        </div>
    </section>

    <!-- feedback section -->
    <section>
        <div class="feedback-container">
            <h2>Real stories from travelers</h2>
        </div>
        <div class="feedback-item">
            <div class="card">
                <p>"Booking with GoTravel was a breeze! Their team helped me plan an  amazing trip, and I couldn't be happier with the experience. Can't wait  for my next adventure with them!"</p>
                <div class="user-details">
                    <div class="img">
                        <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?" alt="user img">
                    </div>
                    <div class="desc">
                        <h4>Sarah Johson</h4>
                        <p>Silver plan</p>
                    </div>
                </div>  
            </div>

            <div class="card">
                <p>"I've been using GoTravel for several years, and they never disappoint. From their expert recommendations to their easy booking process, every trip with them has been fantastic."</p>
                <div class="user-details">
                    <div class="img">
                        <img src="https://images.pexels.com/photos/775358/pexels-photo-775358.jpeg?" alt="user img">
                    </div>
                    <div class="desc">
                        <h4>Michael Smith</h4>
                        <p>Gold plan</p>
                    </div>
                </div>  
            </div>

            <div class="quote-icon">
                <i class='bx bxs-quote-alt-right'></i>
            </div>
        </div>
    </section>

    <!-- partner section -->
    <section>
        <div class="partner-container">
            <div class="partner-title">
                <h2>Over partners</h2>
            </div>
            <div class="item">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d3/2023-Logo-Expedia.png" alt="partner img">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Airbnb_Logo_B%C3%A9lo.svg/1280px-Airbnb_Logo_B%C3%A9lo.svg.png" alt="partner img">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Stripe_Logo%2C_revised_2016.svg/2560px-Stripe_Logo%2C_revised_2016.svg.png" alt="partner img">
            </div>
        </div>
    </section>

    <?php
        include_once "../includes/footer.php";
    ?>
</body>
</html>
