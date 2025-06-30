<?php
session_start();
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // SMTP server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'kalernavi760@gmail.com';
    $mail->Password   = 'bsaemeffplficbfn';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Sender & recipient
    $mail->setFrom('kalernavi760@gmail.com', 'Website Contact Form');
    $mail->addReplyTo($_POST['email'], $_POST['name']); 
    $mail->addAddress('snavi4551@gmail.com');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = htmlspecialchars($_POST['subject']);
    $mail->Body    = "
        <h3>New Contact Message</h3>
        <p><strong>Name:</strong> " . htmlspecialchars($_POST['name']) . "</p>
        <p><strong>Email:</strong> " . htmlspecialchars($_POST['email']) . "</p>
        <p><strong>Phone:</strong> " . htmlspecialchars($_POST['phone']) . "</p>
        <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($_POST['message'])) . "</p>
    ";

    $mail->send();
    $_SESSION['form_status'] = ['type' => 'success', 'message' => 'Your message has been sent successfully.'];
} catch (Exception $e) {
    $_SESSION['form_status'] = ['type' => 'error', 'message' => "Message could not be sent. Error: {$mail->ErrorInfo}"];
}

header("Location: index.php");
exit;