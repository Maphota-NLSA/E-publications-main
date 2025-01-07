<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stay informed about NLSA services, vacancies, tenders, and events with our user-friendly platform.">
    <meta name="keywords" content="NLSA, Library, Vacancies, Tenders, News, Events">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>

    <!-- Tab icon -->
    <link href="..assets/img/favicon.webp" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Nunito|Poppins" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">

    <!-- Main CSS -->
    <link href="../assets/css/index.css" rel="stylesheet">

    <!-- Inline Styles -->
    <style>
        #header {
            background: linear-gradient(90deg, red, green, blue);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        #navbar ul li a.active {
            color: #ffffff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header id="header" class="fixed-top animate__animated animate__fadeInDown">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="welcome.html" class="logo">
                <img src="../assets/img/NLSA-logo.png" alt="National Library Logo" class="img-fluid" style="width:30%; height:30%">
            </a>
            <nav id="navbar" class="navbar" role="navigation">
                <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">Overview</a></li>
                    <li><a href="adminlogin.php" class="getstarted">Admin</a></li>
                    <li><a href="cataloguerlogin.php" class="getstarted">Cataloguer</a></li>
                    <li><a href="form.php" class="getstarted">Form view</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle" tabindex="0" role="button" aria-label="Toggle navigation"></i>
            </nav>
        </div>
    </header>

    <script>
        document.querySelector('.mobile-nav-toggle').addEventListener('click', function () {
            const navbar = document.getElementById('navbar');
            navbar.classList.toggle('navbar-mobile');
        });
    </script>
</body>
</html>
