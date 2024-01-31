<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\DETS_DEMO\vendor\autoload.php';

// Function to generate a random token
function generateToken() {
    return bin2hex(random_bytes(32));
}

// Your database connection and user retrieval logic should be implemented here

// Assuming you have retrieved the user's email from the database
$userEmail = 'priyajoshi1613@gmail.com';

// Generate a unique token and store it in the database for the user
$resetToken = generateToken();

// Store $resetToken in the database along with the user's email for verification

// Send an email with the reset link
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'kagdasakshi09@gmail.com';
    $mail->Password = 'qmqe rosa rkev qlcw';
    $mail->Port = 587;

 // Additional configuration...
     $mail->SMTPSecure = 'tls';
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ],
    ];

    $mail->setFrom('kagdasakshi09@gmail.com', 'sakshi');
    $mail->addAddress('priyajoshi1613@gmail.com' , 'Priya');

    $mail->isHTML(true);
    $mail->Subject = 'Password Reset';
    $mail->Body = 'Click the following link to reset your password: <a href="https://yourwebsite.com/reset_password_confirm.php?token=' . $resetToken . '">Reset Password</a>';

    $mail->send();

    echo 'Password reset email sent. Check your inbox.';
} catch (Exception $e) {
    echo 'Error sending email: ', $mail->ErrorInfo;
}
?>
