<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\DETS_DEMO\vendor\autoload.php';

// Function to send email
function sendResetEmail($email, $token) {
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

        //Recipients
        $mail->setFrom('kagdasakshi09@gmail.com', 'sakshi');
        $mail->addAddress('sakshikagda8@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $resetLink = 'C:\xampp\htdocs\DETS_DEMO\admin\changepass.php' . $token;
        $mail->Body    = "Click the following link to reset your password: <a href='changepass.php'>$resetLink</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expense_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a unique token
function generateToken() {
    return bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $token = generateToken();
        $expirationTime = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        $updateSql = "UPDATE users SET reset_token = '$token', token_expiration = '$expirationTime' WHERE email = '$email'";
        $conn->query($updateSql);

        if (sendResetEmail($email, $token)) {
            echo "Reset email sent. Check your email for instructions.";
        } else {
            echo "Error sending reset email.";
        }
    } else {
        echo "Email not found. Please try again.";
    }
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Budget Buddy</title>
 
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.ico" />
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="assets/images/logo.png">
              </div>
              <h4>Forgot Password?</h4>
              <form class="pt-3" method="POST" action="">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email">
                </div>
                <div class="mt-3 text-center">
                  <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SEND</a>
                </div>
                <div class="text-center mt-4 font-weight-light"> <a href="login.php" class="text-primary">Back to
                    Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <!-- endinject -->
</body>
</html>