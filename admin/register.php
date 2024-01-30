<?php
// Define your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "expense_db";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if(! $conn)
	{
	  die("connection failed=".$conn->connect_error);
	}
	// echo "connected successfully<br>";
  if (isset($_REQUEST['submit'])) {
    
    $username = ($_POST["username"]);
    $email = ($_POST["email"]);
    $password = ($_POST["password"]);
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
      echo "Error: Passwords do not match.";
  } else {
      // Hash the password
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = "INSERT INTO users (username, email, password, confirm_password) VALUES ('$username', '$email', '$password','$confirm_password')";

    if ($conn->query($sql) == TRUE) {
        echo "Registration successful!";
        header("Location: login.php");
         exit();

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
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
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputUsername1"
                    placeholder="Username" name="username"   Required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email"   Required>
                </div>

                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1"
                    placeholder="Password" name="password"  Required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1"
                    placeholder="Confirm Password" name="confirm_password" Required>
                </div>


                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions </label>
                  </div>
                </div>
                
                <div class="mt-3 text-center" name="submit">
                  <button type="submit"  name="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" ><a > SIGN UP</a></button>
                </div>
                <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login.php"
                    class="text-primary">Login</a>
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