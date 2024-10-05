<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Generate OTP
$otp = rand(100000, 999999);


$email = 'recipient_email@example.com'; 
$username = 'Recipient Name'; 

// Send OTP via email
$mail = new PHPMailer(true);
try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com'; // Set your SMTP server (e.g., 'smtp.gmail.com' for Gmail)
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@example.com'; // Your email address
    $mail->Password = 'your_password'; // Your email password (consider using an app password for security)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use PHPMailer::ENCRYPTION_SMTPS for SSL
    $mail->Port = 587; // TCP port to connect to (use 465 for SSL)

    // Email setup
    $mail->setFrom('your_email@example.com', 'Mailer'); // Sender's email and name
    $mail->addAddress($email, $username); // Recipient's email and name

    // Email content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Your OTP Code';
    $mail->Body = "Your OTP code is: <strong>$otp</strong>"; // Use <strong> for better visibility

    // Send email
    $mail->send();
    echo 'OTP has been sent to your email.';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>
