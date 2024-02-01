<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\DETS_DEMO\vendor\autoload.php';

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expense_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email exists, generate a unique identifier (e.g., user ID)
        $row = $result->fetch_assoc();
        $userId = $row["user_id"];

        // Compose the email with a one-time link
        $resetLink = "http://localhost/DETS_DEMO/admin/confirm_password.php?user_id=$userId";
        $subject = "Password Reset";
        $message = "Click the following link to reset your password: $resetLink";

        // Send the email
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
            $mail->addAddress('sakshikagda8@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            echo 'Email has been sent with instructions to reset your password.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Email not found.';
    }
}

$conn->close();
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
              <form class="pt-3" method="POST" action="confirm_password.php">
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