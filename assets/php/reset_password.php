<?php

include 'conn.php';

require "vendor/autoload.php";
require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

    $token = $_GET["token"];
    $token_hash = hash("sha256", $token);
    $sql = "SELECT * FROM users
            WHERE reset_token_hashed = ?";

    $stmt = $conn->prepare($sql);
    $stmt-> bind_param("s", $token);

    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user === null) {
        die("token not found!");
    }

    if(strtotime($user["reset_token_expires_at"]) <= time()){
        die("token has expired");
    }

    echo "token is valid and hasn't expired";
?>