<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Daily Expense Tracker System</title>
    <script>
        function changePassword() {
            var currentPassword = document.getElementById('exampleInputOld1').value;
            var newPassword = document.getElementById('exampleInputNew1').value;
            var confirmPassword = document.getElementById('exampleInputConfirm1').value;
            // var errorMessage = document.getElementById('errorMessage');

            // Reset error message
            // errorMessage.textContent = '';

            // Check if current password is valid (you may want to replace this check with a more secure method)
            if (currentPassword !== 'exampleInputOld1') {
              alert('Invalid current password');
                return false;
            }

            // Check if new password and confirm password match
            else if (newPassword !== confirmPassword) {
                 alert( 'New password and confirm password do not match');
                return false;
            }

            // Perform the password change logic here (you may want to send an API request to the server)

            // Display success message (you can replace this with your desired behavior)
            alert('Password changed successfully!');
        }
    </script>
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
                            <h4>Want to Change Password?</h4>
                            <form class="pt-3" onsubmit="changePassword()">
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputOld1"
                                        name="currentPassword" placeholder="Old Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputNew1"
                                        name="newPassword" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputConfirm1" name="confirmPassword" placeholder="Confirm Password">
                                </div>

                                <div class="mt-3 text-center">
                                    <button type="submit" name="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"><a>SAVE</a></button>
                                    <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                        href="index.php">BACK</a>
                                </div>

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