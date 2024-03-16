<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>navbar</title>
</head>
<body>
     <nav>
        <div class="nav-logo">
            <h1><a href="../php/index.php">GoTravel.</a></h1>
        </div>
        <div class="nav-links">
            <ul>
                <li><a href="../php/index.php">Home</a></li>
                <li><a href="../php/package.php">Tours</a></li>
                <li><a href="../php/membership.php">Membership</a></li>
                <li><a href="#">Forum</a></li>
                <li><a href="../php/about.php">About us</a></li>
                <li><a href="../php/contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="nav-button">
            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <div class="username">
                <p><?= htmlspecialchars($_SESSION['username']) ?></p>
            </div>
            <?php else: ?>
            <a href="../php/login.php">Log in</a>
            <div class="nav-signup">
                <a href="../php/signup.php">Sign up</a>
            </div>
            <?php endif; ?>
            <div class="logout">
                <a href="../php/logout.php"><i class="bx bx-log-out-circle bx-sm"></i></a>
            </div>
        </div>
    </nav>
</body>
</html>
