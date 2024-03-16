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
    <link rel="stylesheet" href="../css/package.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Tour package</title>
</head>
<body>
    <?php
        session_start();
        require("../php/dbconnect.php");
        include_once "../includes/navbar.php";
    ?>

    <!--trip teaser section -->
    <section>
        <div class="item-container">
            <h2>Tour Packages</h2>
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
</body>
</html>