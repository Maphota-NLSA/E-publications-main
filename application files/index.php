<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Tab icon -->     
    <link href="../assets/img/favicon.webp" rel="icon">
    
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet"> <!-- Animation CSS -->

    <!-- Main CSS file -->
    <link href="../assets/css/index.css" rel="stylesheet">

    <script>
        // JavaScript function for smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
          anchor.addEventListener('click', function (e) {
            e.preventDefault();
    
            document.querySelector(this.getAttribute('href')).scrollIntoView({
              behavior: 'smooth'
            });
          });
        });
    </script>
</head> 

<body>
    <!-- Include Header -->
    <?php include 'headerr.php'; ?>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="animate__animated animate__fadeIn animate__delay-1s">
        <div class="hero-container">
            <h3>Welcome to <strong>NLSA</strong></h3>
            <h1>Electronic Publication</h1>
            <h2>Bibliography form</h2>
            <a href="#about" class="btn-get-started scrollto animate__animated animate__pulse animate__infinite">Learn more about E-Pubs</a>
        </div>
    </section>

    <main id="main"> 
        <section id="about" class="about">
            <div class="container">
                <div class="section-title">
                    <h2 class="animate__animated animate__fadeInLeft">Overview</h2>
                    <h3>Learn More <span>About the E-publications</span></h3>
                    <p>The E-Pubs will help different publishers file their books and receive ISBNs for each book.</p>
                </div>
            </div>
        </section>
        <!-- Additional Sections Here -->
    </main>

    <!-- Include Footer -->
    <footer id="footer" class="animate__animated animate__fadeInUp">
        <div class="container d-md-flex py-4">
            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    Copyright <strong><span>NLSA</span></strong>. All Rights Reserved
                </div>
            </div>

            <!-- Social Media Icons -->
            <div class="social-links text-center text-md-end pt-3 pt-md-0">
                <a href="https://www.facebook.com/NLSA" class="facebook" target="_blank">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://www.twitter.com/NLSA" class="twitter" target="_blank">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="https://www.instagram.com/NLSA" class="instagram" target="_blank">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="https://www.linkedin.com/company/NLSA" class="linkedin" target="_blank">
                    <i class="bi bi-linkedin"></i>
                </a>
            </div>
        </div>
    </footer>
</body>
</html>
