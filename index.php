<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Homepage</title>
</head>
<body>
    <?php
        include_once "navbar.php";
    ?>

    <!-- header section -->
    <section>
        <div class="header-img">
            <img src="https://images.pexels.com/photos/4275885/pexels-photo-4275885.jpeg?" alt="background img">
        </div>
        <div class="header-container">
            <h1>Explore the World's <br>Wonders</h1>
            <p>Your gateway to global exploration with GoTravel.</p>
            <div class="section-btn">
                <a href="#">Start exploring</a>
            </div>
        </div>
        <div class="header-additional">
            <div class="text">
                <h4>National Route 40</h4>
                <p>Argentina</p>
            </div> 
            <div class="bg">
                <img src="https://images.pexels.com/photos/4275885/pexels-photo-4275885.jpeg?" alt="img">
            </div>
        </div>
        <div class="header-social">
            <a href="#"><i class='bx bxl-instagram-alt bx-sm'></i></a>
            <a href="#"><i class='bx bxl-twitter bx-sm'></i></a>
            <a href="#"><i class='bx bxl-facebook-circle bx-sm'></i></a>
        </div>
    </section>

    <!-- service section !-->
    <section>
        <div class="service-container">
            <h2>Top values for everyone</h2>
            <p>We provide a wide range of services to our customers</p>
        </div>
        <div class="service-type">
            <div class="list">
                <div class="round"><i class='bx bxs-id-card bx-sm'></i></div>
                <h4>Expert guidace</h4>
                <p>Get insider tips for<br> your travel</p>
            </div>
            <div class="list">
                <div class="round"><i class='bx bxs-discount bx-sm'></i></div>
                <h4>Exclusive deals</h4>
                <p>Enjoy member-only<br> discounts</p>
            </div>
            <div class="list">
                <div class="round"><i class='bx bxs-lock bx-sm'></i></div>
                <h4>Expert guidace</h4>
                <p>Secure bookings,<br> worry free</p>
            </div>
            <div class="list">
                <div class="round"><i class='bx bxs-plane-alt bx-sm'></i></div>
                <h4>Expert guidace</h4>
                <p>Plan and book easily,<br> all in one place</p>
            </div>
        </div>
    </section>

    <!--trip teaser section -->
    <section>
        <div class="item-container">
            <h2>Select your trip</h2>
            <div class="item-btn">
                <a href="#">See more</a>
            </div>
        </div>
        <div class="item-list">
            <div class="card">
                <img src="https://images.pexels.com/photos/3408353/pexels-photo-3408353.jpeg?" alt="card img">
                <div class="card-desc">
                    <h4>Japan</h4>
                    <div class="desc">
                        <i class='bx bx-star bx-sm'></i>
                        <p>4.8 (24 Reviews)</p>
                    </div>
                    <div class="desc">
                        <i class='bx bx-map bx-sm'></i>
                        <p>Tokyo,Japan</p>
                    </div>
                    <div class="desc">
                        <i class='bx bx-calendar bx-sm'></i>
                        <p>4 Days, 3 Nights</p>
                    </div>
                    <div class="price">
                        <h3>RM 200</h3>
                        <p>/person</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <img src="https://images.pexels.com/photos/3408353/pexels-photo-3408353.jpeg?" alt="card img">
                <div class="card-desc">
                    <h4>Japan</h4>
                    <div class="desc">
                        <i class='bx bx-star bx-sm'></i>
                        <p>4.8 (24 Reviews)</p>
                    </div>
                    <div class="desc">
                        <i class='bx bx-map bx-sm'></i>
                        <p>Tokyo,Japan</p>
                    </div>
                    <div class="desc">
                        <i class='bx bx-calendar bx-sm'></i>
                        <p>4 Days, 3 Nights</p>
                    </div>
                    <div class="price">
                        <h3>RM 200</h3>
                        <p>/person</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <img src="https://images.pexels.com/photos/3408353/pexels-photo-3408353.jpeg?" alt="card img">
                <div class="card-desc">
                    <h4>Japan</h4>
                    <div class="desc">
                        <i class='bx bx-star bx-sm'></i>
                        <p>4.8 (24 Reviews)</p>
                    </div>
                    <div class="desc">
                        <i class='bx bx-map bx-sm'></i>
                        <p>Tokyo,Japan</p>
                    </div>
                    <div class="desc">
                        <i class='bx bx-calendar bx-sm'></i>
                        <p>4 Days, 3 Nights</p>
                    </div>
                    <div class="price">
                        <h3>RM 200</h3>
                        <p>/person</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <img src="https://images.pexels.com/photos/3408353/pexels-photo-3408353.jpeg?" alt="card img">
                <div class="card-desc">
                    <h4>Japan</h4>
                    <div class="desc">
                        <i class='bx bx-star bx-sm'></i>
                        <p>4.8 (24 Reviews)</p>
                    </div>
                    <div class="desc">
                        <i class='bx bx-map bx-sm'></i>
                        <p>Tokyo,Japan</p>
                    </div>
                    <div class="desc">
                        <i class='bx bx-calendar bx-sm'></i>
                        <p>4 Days, 3 Nights</p>
                    </div>
                    <div class="price">
                        <h3>RM 200</h3>
                        <p>/person</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- membership section -->
    <section>
        <div class="membership-img">
            <img src="https://images.pexels.com/photos/571169/pexels-photo-571169.jpeg?" alt="membership img">
        </div>
        <div class="membership-container">
            <h2>Travel with membership benefits</h2>
            <p>Join our community of travelers and enjoy exclusive perks with our  membership <br>program. Whether you're a seasoned explorer or embarking on  your first adventure, <br>becoming a member of Go Travel Sdn Bhd opens the  door to a world of possibilities.</p>
            <div class="membership-btn">
                <a href="#">Learn more</a>
            </div>
        </div>
    </section>

    <!-- feedback section -->
    <section>
        <div class="feedback-container">
            <h2>Real stories from travelers</h2>
        </div>
        <div class="feedback-item">
            <div class="card">
                <p>"Booking with Go Travel was a breeze! Their team helped me plan an  amazing trip, and I couldn't be happier with the experience. Can't wait  for my next adventure with them!"</p>
                <div class="user-details">
                    <div class="img">
                        <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?" alt="user img">
                    </div>
                    <div class="desc">
                        <h4>Sarah Johson</h4>
                    </div>
                </div>  
            </div>

            <div class="card">
                <p>"Booking with Go Travel was a breeze! Their team helped me plan an  amazing trip, and I couldn't be happier with the experience. Can't wait  for my next adventure with them!"</p>
                <div class="user-details">
                    <div class="img">
                        <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?" alt="user img">
                    </div>
                    <div class="desc">
                        <h4>Sarah Johson</h4>
                    </div>
                </div>  
            </div>

            <div class="quote-icon">
                <i class='bx bxs-quote-alt-right'></i>
            </div>
        </div>
    </section>

    <!-- partner section -->
    <section>
        <div class="partner-container">
            <div class="partner-title">
                <h2>Over partners</h2>
            </div>
            <div class="item">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d3/2023-Logo-Expedia.png" alt="partner img">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Airbnb_Logo_B%C3%A9lo.svg/1280px-Airbnb_Logo_B%C3%A9lo.svg.png" alt="partner img">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Stripe_Logo%2C_revised_2016.svg/2560px-Stripe_Logo%2C_revised_2016.svg.png" alt="partner img">
            </div>
        </div>
    </section>

    <?php
        include_once "footer.php";
    ?>
</body>
</html>
