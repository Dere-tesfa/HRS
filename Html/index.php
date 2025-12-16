<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRS</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../font/css/all.css">
    <link rel="stylesheet" href="../font/css/all.min.css">
    <script src="../font/js/all.js"></script>
    <script src="../font/js/all.min.js"></script>
</head>

<body>
    <!-- header -->

    <header class="header">
        <div class="header-logo"><a href="index.php"><img src="../images/logo.png" alt="logo"></a></div>
        <h2 class="header-title">HR-SYSTEM</h2>
        <nav class="header-nav">
            <li class="header-nav-items"><a href="index.php">HOME</a></li>
            <li class="header-nav-items"><a href="#about">ABOUT</a></li>
            <li class="header-nav-items"><a href="#service">SERVICE </a></li>
            <li class="header-nav-items"><a href="#contact">CONTACT </a></li>
        </nav>
        <div class="actions">
           <a href="../components/login.php"> <button class="header-login-button">login</button></a>
            <a href="../components/signup.php"> <button class="header-signup-button">signup</button></a>
 
            <button class="menu-button" onclick="toggleMenu()"><i class="fa-solid fa-bars"></i></button>    
        </div>
    </header>
<aside class="side-nav">
    <ul class="side-nav-lists">
        <li class="side-nav-items"><a href="index.php">HOME</a></li>
        <li class="side-nav-items"><a href="#about">ABOUT</a></li>
        <li class="side-nav-items"><a href="#service">SERVICE </a></li>
        <li class="side-nav-items"><a href="#contact">CONTACT </a></li>
    </ul>
</aside>

    <section id="about">
        <div class="hero">
            <div class="hero_content">
                <h1 class="hero_titles">We Are Hiring</h1>
                <p>Our Human Resources Management System is a comprehensive platform built to simplify and enhance HR
                    operations. It automates routine tasks, centralizes employee information, and supports key processes
                    such as hiring, onboarding, attendance tracking, performance evaluation, and benefits
                    administration.
                    With intuitive dashboards and real-time insights, the system helps HR professionals focus on
                    strategic
                    initiatives while improving employee engagement and organizational productivity.</p>
                <button class="primary_btn">Apply Now</button>
            </div>

        </div>
    </section>
    <div class="hero-card-container show">
        <div class="hero__card">
            <i class="fa-solid fa-building-columns card_icon"></i>
            <h3>Join Our Team</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab repellat ducimus, ea est qui voluptatem
            </p>
            <button class="secondary__btn">learn more</button>
        </div>
        <div class="hero__card">
            <i class="fa-solid fa-people-line card_icon"></i>
            <h3>Join Our Team</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab repellat ducimus, ea est qui voluptatem
            </p>
            <button class="secondary__btn">learn more</button>
        </div>
        <div class="hero__card">
            <i class="fa-solid fa-people-line card_icon"></i>
            <h3>Join Our Team</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab repellat ducimus, ea est qui voluptatem
            </p>
            <button class="secondary__btn">learn more</button>
        </div>
        <div class="hero__card">
            <i class="fa-solid fa-building-columns card_icon"></i>
            <h3>Join Our Team</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab repellat ducimus, ea est qui voluptatem
            </p>
            <button class="secondary__btn">learn more</button>
        </div>
    </div>
    <section id="service">
        <div class="our__services">
            <h2 class="our_title">Our Service</h2>
            <div class="our__content">
                <div class="our_service">
                    <i><i class="fa-solid fa-people-roof"></i></i>
                    <h2 class="service_title">People Roof</h2>
                    <p class="our_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
                </div>
                <div class="our_service">
                    <i><i class="fa-solid fa-user-shield"></i></i>
                    <h2 class="service_title">Good Security</h2>
                    <p class="our_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
                </div>
                <div class="our_service">
                    <i><i class="fa-solid fa-file-pen"></i></i>
                    <h2 class="service_title">File Management</h2>
                    <p class="our_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
                </div>
                <div class="our_service">
                    <i><i class="fa-solid fa-chalkboard-user"></i></i>
                    <h2 class="service_title">HR Management</h2>
                    <p class="our_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
                </div>
                <div class="our_service">
                    <i><i class="fa-solid fa-file-pen"></i></i>
                    <h2 class="service_title">Job Opportunities</h2>
                    <p class="our_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
                </div>
                <div class="our_service">
                    <i><i class="fa-solid fa-file-pen"></i></i>
                    <h2 class="service_title"> Support</h2>
                    <p class="our_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer class="footer">
        <a class="back_arrow" href="index.php">^</a>
        <p class="footer-copyright">&copy; 2025 All Rights Are Reserved.</p>

<div class="footer-contents" id="contact">
    <div class="footer-lists">
        <h4 class="footer-titles">LEARN MORE</h4>
        <a href="">How it works?</a>
        <a href="">Useful tools</a>
        <a href="">Pricing</a>
        <a href="">Sitemap</a>
    </div>

    <div class="footer-lists">
        <h4 class="footer-titles">SUPPORT</h4>
        <a href="">FAQ</a>
        <a href="">Contact us</a>
        <a href="">Help Desk</a>
        <a href="">Knowledge base</a>
    </div>

    <div class="footer-lists">
        <h4 class="footer-titles">ABOUT US</h4>
        <a href=""> About us</a>
        <a href=""> Careers</a>
        <a href="">Terms of service</a>
        <a href="">Privacy Policy</a>
    </div>
    <div class="footer-lists">
        <h4 class="footer-titles">CONNECT WITH US</h4>
        <ul  class="footer-social-media">
            <a href=""><i class="fa-brands fa-twitter"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-linkedin"></i></a>
            <a href=""><i class="fa-brands fa-facebook"></i></a>
        </ul>
      
    </div>

</div>

    
    </footer>
    <script>
        function toggleMenu() {
            const sidenav = document.querySelector('.side-nav');
      sidenav.style.left = sidenav.style.left === '-400px' ? '0' : '-400px';
        }
    </script>
</body>

</html>