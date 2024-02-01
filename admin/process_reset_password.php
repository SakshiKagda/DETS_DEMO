<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\DETS_DEMO\vendor\autoload.php';

// Function to send email

function sendResetEmail($email, $token) {
    $mail = new PHPMailer(true);

// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expense_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        $sql = "SELECT * FROM users WHERE reset_token = '$token' AND token_expiration > NOW()";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $updateSql = "UPDATE users SET password = '$newPassword', reset_token = NULL, token_expiration = NULL WHERE reset_token = '$token'";
            $conn->query($updateSql);

            echo "Password successfully reset. You can now log in with your new password.";
        } else {
            echo "Invalid or expired token. Please try again.";
        }
    } else {
        echo "Password and Confirm Password do not match. Please try again.";
    }
}
}


?>
