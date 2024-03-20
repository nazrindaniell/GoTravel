<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect to the welcome page
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header("Location: ../php/index.php");
    exit();
}

// Include the database connection file
require_once "../php/dbconnect.php";

// Define the variable and initialize with empty values
$username = $password = "";
$usernameErr = $passwordErr = $loginErr = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $usernameErr = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $passwordErr = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($usernameErr) && empty($passwordErr)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("Location: ../php/index.php");
                            exit();
                        } 
                        else{
                            // Password is not valid, display a generic error message
                            $loginErr = "Invalid username or password.";
                        }
                    }
                } 
                else{
                    // Username doesn't exist, display a generic error message
                    $loginErr = "Invalid username or password.";
                }
            } 
            else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet" href="../css/login.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
</head>
<body>
    <?php 
        include_once "../includes/navbar.php";
    ?>
    <section>
        <div class="login-container">
            <div class="grid">
                <div class="left-wrapper">
                    <div class="login-title">
                        <h2>Login to GoTravel</h2>
                        <p>Experience travel like never before</p>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-wrapper">
                            <label for="username"><?php echo $usernameErr;?></label>
                            <input type="text" name="username" placeholder="Enter your username">
                        </div>
                        <div class="form-wrapper">
                            <label for="password"><?php echo $passwordErr;?></label>
                            <input type="password" name="password" placeholder="Enter your password">
                        </div>
                       
                        <div class="form-submit">
                            <input type="submit" name="submit-btn" value="Log in">
                        </div>
                    </form>
                    <p>Don't have an account? <span><a href="../php/signup.php">Sign up</a></span></p>
                </div>
                <div class="right-wrapper">
                    <div class="bg-img">
                        <img src="https://images.pexels.com/photos/5480833/pexels-photo-5480833.jpeg" alt="login img">
                    </div>
                    <div class="quote">
                        <h2>Embark on <br>your journey</h2>
                        <p>is our invitation to begin your adventure with GoTravel. It's the  starting point for unforgettable experiences, seamless travel, and  endless exploration.</p>
                    </div>
                    <div class="brand">
                        <h4>GoTravel.</h4>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</body>
</html>