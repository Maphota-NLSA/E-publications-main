<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stay informed about NLSA services, vacancies, tenders, and events with our user-friendly platform.">
    <meta name="keywords" content="NLSA, Library, Vacancies, Tenders, News, Events">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>

    <!-- Tab icon -->
    <link rel="icon" href="../assets/img/favicon.webp">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">

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
            background: rgb(233,233,233);
            background: linear-gradient(90deg, rgba(233,233,233,0.8828348214285714) 35%, rgba(41,179,87,1) 74%, rgba(31,33,112,1) 115%);
            padding: 14px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 999;
        }

        #header .logo img {
            width: 120px;
            height: auto;
        }

        #navbar {
            display: flex;
            align-items: center;
        }

        #navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }

        #navbar ul li {
            position: relative;
        }

        #navbar ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            padding: 10px 15px;
            transition: color 0.3s, background-color 0.3s;
            border-radius: 5px;
        }

        #navbar ul li a:hover,
        #navbar ul li a.active {
            color: #000;
            background-color: #fff;
        }

        .mobile-nav-toggle {
            display: none;
            font-size: 28px;
            color: #fff;
            cursor: pointer;
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
            .mobile-nav-toggle {
                display: block;
            }

            #navbar {
                flex-direction: column;
                align-items: flex-start;
                position: fixed;
                top: 60px;
                right: -100%;
                width: 100%;
                background: linear-gradient(90deg, red, green, blue);
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transition: right 0.4s;
                overflow-y: auto;
                padding: 20px;
                z-index: 998;
            }

            #navbar.navbar-mobile {
                right: 0;
            }

            #navbar ul {
                flex-direction: column;
                gap: 15px;
            }

            #navbar ul li a {
                padding: 12px;
                width: 100%;
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <header id="header" class="animate__animated animate__fadeInDown">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo">

                <img src="../assets/img/NLSA-logo.png" alt="National Library Logo" class="img-fluid" style="width:50%; height:50%">
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
