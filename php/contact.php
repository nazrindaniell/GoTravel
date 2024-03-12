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
                        <form action="" method="POST">
                            <div class="wrapper">
                                <div class="group">
                                    <label for="fname">First name</label>
                                    <input type="text" name="fname" placeholder="Nazrin">
                                </div>
                                <div class="group">
                                    <label for="lname">Last name</label>
                                    <input type="text" name="lname" placeholder="Daniel">
                                </div>
                                <div class="group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" placeholder="example@gmail.com">
                                </div>
                                <div class="group">
                                    <label for="number">Phone number</label>
                                    <input type="text" name="number" placeholder="+60123456789">
                                </div>
                                <div class="group">
                                    <label for="message">Message</label>
                                    <input type="text" name="message" placeholder="Write your message...">
                                </div>
                            </div>
                            <div class="round">
                                <input type="checkbox" name="checkbox" class="checkbox-round">
                                <label for="checkbox">I confirm all the information stated are true</label>
                            </div>
                            <input type="submit" value="Send Message">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>