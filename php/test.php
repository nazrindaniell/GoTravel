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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Packages</title>
    <style>
        .package {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 10px;
        }
        .package img {
            max-width: 100px;
            max-height: 100px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>All Packages</h1>
    <div class="package-list">
        <?php if(!empty($packages)): ?>
            <?php foreach ($packages as $package): ?>
                <div class="package">
                    <h2><?= $package['package_name'] ?></h2>
                    <p><?= $package['rating'] ?></p>
                    <p><?= $package['reviews'] ?></p>
                    <p><?= $package['location'] ?></p>
                    <p>Price: <?= $package['price'] ?></p>
                    <?php if(!empty($package['images'])): ?>
                        <div class="images">
                            <?php foreach ($package['images'] as $image): ?>
                                <img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <a href="packageDetails.php?package_id=<?= $package['package_id'] ?>">Purchase</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No packages available</p>
        <?php endif; ?>
    </div>
</body>
</html>
