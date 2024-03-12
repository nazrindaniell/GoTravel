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
                    <form action="" method="POST">
                        <div class="form-wrapper">
                            <label for="username">Username</label>
                            <input type="text" name="username" placeholder="Enter your username">
                        </div>
                        <div class="form-wrapper">
                            <label for="password">Password</label>
                            <input type="text" name="password" placeholder="Enter your password">
                        </div>
                       
                        <div class="form-submit">
                            <input type="submit" name="login-btn" value="Log in">
                        </div>
                    </form>
                    <p>Don't have an account? <span><a href="../php/signup.php">Sign up</a></span></p>
                </div>
                <div class="right-wrapper">
                    <div class="bg-img">
                        <img src="https://images.pexels.com/photos/5480833/pexels-photo-5480833.jpeg?" alt="login img">
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