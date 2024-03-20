<?php
    //start or resume the session
    session_start();

    // Check if the user is already logged in, if yes then redirect to the welcome page
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header("Location: ../php/index.php");
    exit();
    }


    // Establish the connection with the database
    require_once "dbconnect.php";

    // Define variables and initialize with empty values
    $username = $email = $password = $confirmPassword = "";
    $usernameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";

    // Main code
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate the username
        if (empty(trim($_POST['username']))) {
            $usernameErr = "Please enter your username";
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
            $usernameErr = "Username can only contain letters, numbers, and underscores.";
        } else {
            // Check if the username already exists
            $checkUsername = "SELECT id FROM users WHERE username = ?";
            $stmtCheck = mysqli_prepare($conn, $checkUsername);
            if (!$stmtCheck) {
                die("Error preparing statement: " . mysqli_error($conn));
            }

            mysqli_stmt_bind_param($stmtCheck, "s", $param_username_check);
            $param_username_check = trim($_POST['username']);

            if (mysqli_stmt_execute($stmtCheck)) {
                //store result
                mysqli_stmt_store_result($stmtCheck);
                if (mysqli_stmt_num_rows($stmtCheck) > 0) {
                    $usernameErr = "This username is already taken.";
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                die("Error executing statement: " . mysqli_error($conn));
            }

            mysqli_stmt_close($stmtCheck);
        }

        //validate the email
        if (empty(trim($_POST['email']))) {
            $emailErr = "Please enter your email";
        }
        else{
            $email = trim($_POST['email']);
            //check if email address is well-formed
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $emailErr = "Invalid email format";
            }
        }

        // Validate the password
        if (empty(trim($_POST['password']))) {
            $passwordErr = "Please enter a password";
        } elseif (strlen(trim($_POST['password'])) < 6) {
            $passwordErr = "Password must have at least 6 characters.";
        } else {
            $password = trim($_POST['password']);
        }

        // Validate confirm password
        if (empty(trim($_POST['confirmPassword']))) {
            $confirmPasswordErr = "Please confirm your password";
        } else {
            $confirmPassword = trim($_POST['confirmPassword']);
            if (empty($passwordErr) && ($password != $confirmPassword)) {
                $confirmPasswordErr = "Password did not match.";
            }
        }

        // Check input errors before inserting into the database
        if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
            // Prepare an insert statement
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

                // Set parameters
                $param_username = $username;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Create a password hash

                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    //retirieve the user ID of the newly inserted user
                    $id = mysqli_insert_id($conn);
                    session_start();
                    //store the session id and username in session variable
                    $_SESSION["loggedin"] = true;
                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $username;

                    // Redirect to the login page
                    header("Location: ../php/index.php");
                    exit();
                } else {
                    die("Error executing statement: " . mysqli_error($conn));
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                die("Error preparing statement: " . mysqli_error($conn));
            }
        }
        // Close the connection
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Signup</title>
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
                        <h2>Sign up to GoTravel</h2>
                        <p>Experience travel like never before</p>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-wrapper">
                            <label for="username"><?php echo $usernameErr;?></label>
                            <input type="text" name="username" placeholder="Enter your username">
                        </div>
                        <div class="form-wrapper">
                            <label for="email"><?php echo $emailErr;?></label>
                            <input type="text" name="email" placeholder="Enter your email address">
                        </div>
                        <div class="form-wrapper">
                            <label for="password"><?php echo $passwordErr;?></label>
                            <input type="password" name="password" placeholder="Enter your password">
                        </div>
                        <div class="form-wrapper">
                            <label for="password"><?php echo $confirmPasswordErr;?></label>
                            <input type="password" name="confirmPassword" placeholder="Confirm your password">
                        </div>
                       
                        <div class="form-submit">
                            <input type="submit" name="signup-btn" value="Sign up">
                        </div>
                    </form>
                    <p>Already have an account? <span><a href="../php/login.php">Log in</a></span></p>
                </div>
                <div class="right-wrapper">
                    <div class="bg-img">
                        <img src="https://images.pexels.com/photos/5480833/pexels-photo-5480833.jpeg" alt="signup img">
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