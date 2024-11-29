<?php
//  Welcome file for the E-Publication application

// Start session
session_start();

// Define the page title dynamically
$pageTitle = "E-publication";

// Include the header
include 'header.php';
?>


<!-- ======= Hero Section ======= -->
<section id="hero" class="animate__animated animate__fadeIn animate__delay-1s">
    <div class="hero-container">
        <h3>Welcome to <strong>NLSA</strong></h3>
        <h1>E-Publication</h1>
        <h2>Bibliography form</h2>
        <a href="#about" class="btn-get-started scrollto animate__animated animate__pulse animate__infinite">Learn more about E-Pubs</a>
    </div>
</section>

<!-- ======= Main Content ======= -->
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

    <div id="services" class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="icon-box animate__animated animate__fadeInUp">
                        <i class="bi bi-briefcase"></i>
                        <h4><a href="login.php">National Library of South Africa staff login</a></h4>
                        <p>Login here</p>
                        <a href="../../application files/catalogueslogin.html" class="getstarted">Login</a>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="icon-box animate__animated animate__fadeInUp animate__delay-1s">
                        <i class="bi bi-card-checklist"></i>
                        <h4><a href="../../application files/form.html">National Library of South Africa E-pubs form</a></h4>
                        <p>View Epubs form here</p>
                        <a href="../../application files/form.html" class="getstarted">Form view</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
// Include the footer
include 'footer.php';
?>
