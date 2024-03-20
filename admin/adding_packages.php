<?php
// Include your database connection file
include '../php/dbconnect.php';

// Function to retrieve all package names
function getAllPackageNames($conn) {
    $sql = "SELECT package_id, package_name FROM packages";
    $result = $conn->query($sql);
    $packageNames = array();
    while ($row = $result->fetch_assoc()) {
        $packageNames[$row['package_id']] = $row['package_name'];
    }
    return $packageNames;
}

// Function to retrieve package details by package ID
function getPackageDetails($conn, $packageId) {
    $sql = "SELECT * FROM packages WHERE package_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $packageId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Initialize package details variable
$packageDetails = array();

// Check if the form is submitted for adding or editing a package
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If the form is submitted for adding a package
    if (isset($_POST['add_package'])) {
        // Retrieve form data and insert package into the database
        $packageName = $_POST['package_name'];
        $rating = $_POST['rating'];
        $reviews = $_POST['reviews'];
        $location = $_POST['location'];
        $duration = $_POST['duration'];
        $price = $_POST['price'];

        // Insert package into the database
        $sql = "INSERT INTO packages (package_name, rating, reviews, location, duration, price) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisdi", $packageName, $rating, $reviews, $location, $duration, $price);
        if ($stmt->execute()) {
            echo "Package added successfully.";
        } else {
            echo "Error adding package: " . $conn->error;
        }
    }
    // If the form is submitted for editing a package
    elseif (isset($_POST['edit_selected_package'])) {
        // Retrieve package details by package ID
        if (isset($_POST['select_package'])) {
            $packageId = $_POST['select_package'];
            $packageDetails = getPackageDetails($conn, $packageId);
        }
    }
    // If the form is submitted for updating a package
    elseif (isset($_POST['edit_package'])) {
        // Retrieve form data and update package in the database
        $packageId = $_POST['package_id'];
        $packageName = $_POST['package_name'];
        $rating = $_POST['rating'];
        $reviews = $_POST['reviews'];
        $location = $_POST['location'];
        $duration = $_POST['duration'];
        $price = $_POST['price'];

        // Update package in the database
        $sql = "UPDATE packages SET package_name = ?, rating = ?, reviews = ?, location = ?, duration = ?, price = ? WHERE package_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssissdi", $packageName, $rating, $reviews, $location, $duration, $price, $packageId);
        if ($stmt->execute()) {
            echo "Package updated successfully.";
        } else {
            echo "Error updating package: " . $conn->error;
        }
    }
}
?>

<!-- HTML form for selecting a package to edit -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="select_package">Select Package to Edit:</label>
    <select name="select_package" id="select_package">
        <?php
        // Retrieve all package names
        $packageNames = getAllPackageNames($conn);
        // Display each package name as an option in the dropdown
        foreach ($packageNames as $packageId => $packageName) {
            echo "<option value='$packageId'>$packageName</option>";
        }
        ?>
    </select>
    <input type="submit" name="edit_selected_package" value="Edit Selected Package">
</form>

<!-- HTML form for adding/editing packages -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <!-- Add hidden field for package ID -->
    <input type="hidden" name="package_id" value="<?php echo isset($_POST['select_package']) ? $_POST['select_package'] : ''; ?>">
    
    <label for="package_name">Package Name:</label>
    <input type="text" name="package_name" value="<?php echo isset($packageDetails['package_name']) ? $packageDetails['package_name'] : ''; ?>" required> VARCHAR<br>
    
    <label for="rating">Rating:</label>
    <input type="text" name="rating" value="<?php echo isset($packageDetails['rating']) ? $packageDetails['rating'] : ''; ?>" required> DECIMAL(3,1)<br>
    
    <label for="reviews">Reviews:</label>
    <input type="text" name="reviews" value="<?php echo isset($packageDetails['reviews']) ? $packageDetails['reviews'] : ''; ?>" required> INT<br>
    
    <label for="location">Location:</label>
    <input type="text" name="location" value="<?php echo isset($packageDetails['location']) ? $packageDetails['location'] : ''; ?>" required> VARCHAR<br>
    
    <label for="duration">Duration:</label>
    <input type="text" name="duration" value="<?php echo isset($packageDetails['duration']) ? $packageDetails['duration'] : ''; ?>" required> VARCHAR<br>
    
    <label for="price">Price:</label>
    <input type="text" name="price" value="<?php echo isset($packageDetails['price']) ? $packageDetails['price'] : ''; ?>" required> DECIMAL(10,2)<br>
    <!-- Add more fields for package details -->

    <input type="submit" name="add_package" value="Add Package">
    <input type="submit" name="edit_package" value="Edit Package">
</form>
