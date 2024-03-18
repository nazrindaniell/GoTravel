<?php
// Include your database connection file
include 'dbconnect.php';

// Function to retrieve all package names along with their IDs
function getAllPackageNames($conn) {
    $sql = "SELECT package_id, package_name FROM packages";
    $result = $conn->query($sql);
    $packageNames = array();
    while ($row = $result->fetch_assoc()) {
        $packageNames[$row['package_id']] = $row['package_name'];
    }
    return $packageNames;
}

// Check if the form is submitted for deleting a package
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_package'])) {
    // Retrieve package ID and name from the form
    $packageId = $_POST['select_package'];

    // Delete the selected package from the database
    $sql = "DELETE FROM packages WHERE package_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $packageId);
    if ($stmt->execute()) {
        echo "Package deleted successfully.";
    } else {
        echo "Error deleting package: " . $conn->error;
    }
}
?>

<!-- HTML form for selecting a package to delete -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="select_package">Select Package to Delete:</label>
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
    <input type="submit" name="delete_package" value="Delete Selected Package">
</form>