<?php

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'C:\xampp\htdocs\SMTP\vendor\autoload.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'kagdasakshi09@gmail.com'; // SMTP username
    $mail->Password   = 'qmqe rosa rkev qlcw';   // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port       = 587; // TCP port to connect to
    
    $mail->SMTPSecure = 'tls';
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ],
    ];
    //Recipients
    $mail->setFrom('kagdasakshi09@gmail.com', ' Sakshi');
    $mail->addAddress('sakshikagda8@gmail.com', 'Priya');


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML

    // Fetch expiry date from the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "expense_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get current date
    $current_date = date("2025-02-18");


    $user_id = 15;
    $sql="SELECT * FROM users WHERE user_id =$user_id";
    $sql = "SELECT * FROM subscription WHERE user_id = $user_id AND end_date = DATE_ADD('$current_date', INTERVAL 3 DAY)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $end_date = $row["end_date"];

            $mail->Subject = 'Your Exclusive Renewal Offer Awaits!';
            $mail->Body    = 'Your subscription is expiring on ' . $end_date . '. Please renew your subscription.';
            $mail->AltBody = 'Your subscription is expiring on ' . $end_date . '. Please renew your subscription.';

            $mail->send();
            echo 'Message has been sent';
        }
    } else {
        echo "0 results";
    }

    $conn->close();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
