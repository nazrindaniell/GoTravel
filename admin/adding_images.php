<?php
// Include your database connection file
include '../php/dbconnect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $packageId = $_POST['package_id']; // Assuming you have a way to get the package ID
    $altText = $_POST['alt_text'];

    // Handle uploaded file
    $targetDirectory = "../uploads/"; // Directory where uploaded files will be stored
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]); // Path to the uploaded file
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // File extension
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        // Allow certain file formats
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $allowedExtensions)) {
            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                // Insert image path into the database
                $sql = "INSERT INTO packages_image (package_id, image_path, alt_text) 
                        VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iss", $packageId, $targetFile, $altText);
                if ($stmt->execute()) {
                    echo "Image added successfully.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "File is not an image.";
    }
}
?>

<!-- HTML form for adding images -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <label for="package_id">Package ID:</label>
    <input type="text" name="package_id" required><br>

    <label for="image">Select Image:</label>
    <input type="file" name="image" id="image" required><br>

    <label for="alt_text">Alt Text:</label>
    <input type="text" name="alt_text" required><br>

    <input type="submit" value="Add Image">
</form>

