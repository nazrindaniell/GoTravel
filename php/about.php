<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet" href="../css/about.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>about</title>
</head>
<body>
    <?php
        include_once "../includes/navbar.php";
    ?>

    <section>
        <div class="about-container">
            <div class="grid">
                <!-- about us section -->
                <div class="about-us-section">
                    <h2>About us</h2>
                    <p>GoTravel is a travel agency founded by avid travelers John and Sarah Smith, GoTravel is driven by a passion for exploration and a commitment to excellence in service. Our mission is simple, to provide travelers with personalized and hassle-free journeys that leave a lasting impression.</p>
                    <div class="grid-wrapper">
                        <div class="info">
                            <h2>150+</h2>
                            <p>Customer satisfied</p>
                        </div>
                        <div class="info">
                            <h2>Top 10</h2>
                            <p>Best travel agency</p>
                        </div>
                    </div>
                </div>
                <div class="about-img">
                    <img src="https://images.pexels.com/photos/2467506/pexels-photo-2467506.jpeg?" alt="about us img">
                </div>
                <!-- our story section -->
                <div class="about-img">
                    <img src="https://images.pexels.com/photos/5993936/pexels-photo-5993936.jpeg?" alt="our story img">
                </div>
                <div class="about-us-section">
                    <h2>Our story</h2>
                    <p>Inspired by our own adventures around the globe, we founded GoTravel with the vision of sharing the joy of travel with others. With years of experience and a deep understanding of what makes a trip truly special, we set out to create a travel agency that offers unique and unforgettable experiences for every traveler.</p>
                    <div class="contact-btn">
                        <a href="#">Get in touch</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- our values section -->
    <section>
        <div class="values-container">
            <h2>Our values</h2>
            <div class="grid">
                <div class="card">
                    <div class="logo">
                        <i class='bx bxs-badge-check bx-lg'></i>
                        <h4>Integrity</h4>
                        <p>We value honesty and ethical conduct, fostering trust with our customers.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="logo">
                        <i class='bx bxs-user-check bx-lg'></i>
                        <h4>Professionalism</h4>
                        <p>Our team delivers exceptional service with expertise and reliability.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="logo">
                        <i class='bx bxs-donate-heart bx-lg'></i>
                        <h4>Customer <br>satisfaction</h4>
                        <p>We exceed expectations with personalized delight.</p>
                    </div>
                </div>
            </div>
        </div>        
    </section>

    <!-- feedback section -->
    <section>
        <div class="feedback-container">
            <h2>Customer testimonials</h2>
        </div>
        <div class="feedback-item">
            <div class="card">
                <p>"Booking with GoTravel was a breeze! Their team helped me plan an  amazing trip, and I couldn't be happier with the experience. Can't wait  for my next adventure with them!"</p>
                <div class="user-details">
                    <div class="img">
                        <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?" alt="user img">
                    </div>
                    <div class="desc">
                        <h4>Sarah Johson</h4>
                        <p>Silver plan</p>
                    </div>
                </div>  
            </div>

            <div class="card">
                <p>"I've been using GoTravel for several years, and they never disappoint. From their expert recommendations to their easy booking process, every trip with them has been fantastic."</p>
                <div class="user-details">
                    <div class="img">
                        <img src="https://images.pexels.com/photos/775358/pexels-photo-775358.jpeg?" alt="user img">
                    </div>
                    <div class="desc">
                        <h4>Michael Smith</h4>
                        <p>Gold plan</p>
                    </div>
                </div>  
            </div>

            <div class="quote-icon">
                <i class='bx bxs-quote-alt-right'></i>
            </div>
        </div>
    </section>
    <?php
        include_once "../includes/footer.php";
    ?>
</body>
</html>