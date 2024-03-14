<?php
    require_once "dbconnect.php";
    session_start();

    //define variables and initialize with empty values
    $fname = $lname = $email = $phone = $message = "";
    $fnameErr = $lnameErr = $emailErr = $phoneErr = $messageErr = "";

    //check if the user is logged in
    if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //validate first name
            if(empty(trim($_POST['fname']))){
                $fnameErr = "required";
            }
            else{
                $fname = $_POST['fname'];
            }

            //validate last name
            if(empty(trim($_POST['lname']))){
                $lnameErr = "required";
            }
            else{
                $lname = $_POST['lname'];
            }

            //validate email
            if(empty(trim($_POST['email']))){
                $emailErr = "required";
            }
            else{
                $email = trim($_POST['email']);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $emailErr = "Invalid email format";
                }
            }

            //validate phone number
            if(empty($_POST['phone'])){
                $phoneErr = "required";
            }
            else{
                $phone = trim($_POST['phone']);
                if(!preg_match('/^[0-9]{10}+$/', $phone)) {
                    $phoneErr = "Invalid phone number format";
                }
            }

            //validate message
            if(empty($_POST['message'])){
                $messageErr = "required";
            }
            else{
                $message = $_POST['message'];
            }

            //check input errors before inserting into the database
            if(empty($fnameErr) && empty($lnameErr) && empty($emailErr) && empty($phoneErr) && empty($messageErr)){
                // Create a prepared statement
                $stmtQuery = "INSERT INTO form (user_id, firstName, lastName, email, phoneNumber, message) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $stmtQuery);

                // Bind parameters
                mysqli_stmt_bind_param($stmt, "isssss", $user_id, $fname, $lname, $email, $phone, $message);

                // Execute the statement
                if(mysqli_stmt_execute($stmt)) {
                    echo "Form submitted successfully!";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            }
        }
        //close the connection
        mysqli_close($conn);
    }
    else{
        //user is not logged in
        //redirect to login page
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(!isset($_SESSION['id'])){
                header("Location: ../php/login.php");
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Contact Us</title>
</head>
<body>
    <?php
        include_once "../includes/navbar.php";
    ?>

    <section>
        <div class="contact-container">
            <div class="grid">
                <div class="left-content">
                    <div class="header">
                        <h2>Contact Us</h2>
                        <p>Any question? We would be happy to help you</p>
                    </div>
                    <div class="contact-information">
                        <div class="box">
                            <i class='bx bx-phone bx-sm'></i>
                            <p>+6012-345-6789</p>
                        </div>
                        <div class="box">
                            <i class='bx bx-envelope bx-sm'></i>
                            <p>nazrindaniel8@gmail.com</p>
                        </div>
                        <div class="box">
                            <i class='bx bx-map bx-sm'></i>
                            <p>No.22 Jalan SG 5/1 Taman Sri Gombak</p>
                        </div>
                    </div>
                    <div class="social-media">
                        <div class="circle">
                            <i class='bx bxl-instagram bx-sm'></i>
                        </div>
                        <div class="circle">
                            <i class='bx bxl-twitter bx-sm'></i>
                        </div>
                        <div class="circle">
                            <i class='bx bxl-facebook bx-sm'></i>
                        </div>
                    </div>
                </div>
                <div class="right-content">
                    <div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                            <div class="wrapper">
                                <div class="group">
                                    <label for="fname">First name <span class="invalid-feedback"><?php echo $fnameErr;?></span></label>
                                    <input type="text" name="fname" placeholder="Alex" class="form-control <?php echo (!empty($fnameErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $fname; ?>">
                                </div>
                                <div class="group">
                                    <label for="lname">Last name <span class="invalid-feedback"><?php echo $lnameErr;?></span></label>
                                    <input type="text" name="lname" placeholder="Turner" class="form-control <?php echo (!empty($lnameErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $lname; ?>">
                                </div>
                                <div class="group">
                                    <label for="email">Email address <span class="invalid-feedback"><?php echo $emailErr;?></span></label>
                                    <input type="email" name="email" placeholder="example@gmail.com" class="form-control <?php echo (!empty($emailErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                </div>
                                <div class="group">
                                    <label for="phone">Phone number <span class="invalid-feedback"><?php echo $phoneErr;?></span></label>
                                    <input type="text" name="phone" placeholder="0123456789" class="form-control <?php echo (!empty($phoneErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
                                </div>
                                <div class="group">
                                    <label for="message">Message <span class="invalid-feedback"><?php echo $messageErr;?></span></label>
                                    <input type="text" name="message" placeholder="Write your message..." class="form-control <?php echo (!empty($messageErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $message; ?>">
                                </div>
                            </div>
                            <input type="submit" name="submit" value="Send Message">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>