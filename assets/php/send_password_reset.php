<?php

include 'conn.php';
require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("YYYY-MM-DDTHH:MM:SS", time() + 60 * 30);

// $mysqli = require __DIR__ ."/conn.php";

$sql = "UPDATE users
        SET reset_token_hashed = ?,
            reset_token_expires_at = ?
        WHERE EmailAddress = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $token, $token_hash, $email);

$stmt->execute();

if($conn->affected_rows){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->Username = "nicolasmahlangu75@gmail.com";
        $mail->Password="ykbq ecat ctyl avbb ";
        $mail->setFrom("no-reply@nlsa.ac.za");
        $mail->addAddress($email);
        $mail->Subject= "Password Reset";
        $mail->Body= <<<END

        Click <a href="http://localhost:81/e-publications/assets/php/reset_password.php?token=$token">here<a/> to reset your password.
        END;

        try{
            $mail->send();
        }catch(Exception $ex){
            echo "Mail could not be sent. Mailer error: {$mail->ErrorInfo}";
        }
        echo "email sent";

}

?>