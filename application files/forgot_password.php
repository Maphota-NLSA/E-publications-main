<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <meta name="description" content="Forgot password page for EQPRS system.">
    <meta name="keywords" content="password reset, forgot password, EQPRS login">

    <!-- Tab Icon -->
    <link href="../assets/img/favicon.webp" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Nunito:300,400,600|Poppins:300,400,600" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Main CSS -->
    <style>
        /* General Body Styling with Background Image */
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url("../assets/img/nlsa_buildings.png") no-repeat center center;
            background-size: cover;
            backdrop-filter: blur(6px); /* Slight blur effect for elegance */
        }

        /* Forgot Password Container Styling */
        .forgot-password-container {
            width: 35%;
            max-width: 500px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.85); /* Semi-transparent white background */
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        /* Heading and Paragraph Styling */
        .forgot-password-container h4 {
            font-family: 'Nunito', sans-serif;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        .forgot-password-container p {
            font-size: 14px;
            color: #666;
            margin-bottom: 25px;
        }

        /* Form Input Fields */
        .password-form input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Submit Button Styling */
        .password-form .button {
            width: 100%;
            padding: 12px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .password-form .button:hover {
            background-color: #004c99;
        }

        /* Back to Login Link */
        .back-to-login {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .back-to-login a {
            text-decoration: none;
            color: #0066cc;
            font-size: 14px;
            font-weight: 500;
        }

        .back-to-login a:hover {
            text-decoration: underline;
        }

        .back-to-login i {
            font-size: 18px;
            color: #0066cc;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .forgot-password-container {
                width: 90%;
                padding: 20px;
            }

            .forgot-password-container h4 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <div class="forgot-password-container">
        <h4>Forgot Password</h4>
        <p>Enter your email address below, and we’ll send you instructions to reset your password.</p>

        <form action="../assets/php/send_password_reset.php" method="POST" class="password-form">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <input type="submit" value="Send Reset Link" class="button">
        </form>

        <div class="back-to-login">
            <i class="bi bi-arrow-left-circle"></i>
            <a href="cataloguerlogin.php">Back to Login</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
