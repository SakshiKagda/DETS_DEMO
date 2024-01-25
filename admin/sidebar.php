<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Expense Tracker System</title>
  <link rel="stylesheet" href="assets/scss/_sidebar.scss">
  <link rel="stylesheet" href="assets/css/style.css">
  
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
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="assets/images/faces/face1.jpg" alt="profile">
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">David Grey. H</span>
            <span class="text-secondary text-small">Project Manager</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Expense</span>
          <i class="menu-arrow"></i>
          <i class=" mdi mdi-cash-multiple menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="viewexpense.php">Manage Expense</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-1" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Income</span>
          <i class="menu-arrow"></i>
          <i class=" mdi mdi-cash menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic-1">
          <ul class="nav flex-column sub-menu">

            <li class="nav-item"> <a class="nav-link" href="viewincome.php">Manage Income</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-2" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Budget</span>
          <i class="menu-arrow"></i>
          <i class=" mdi mdi-briefcase  menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic-2">
          <ul class="nav flex-column sub-menu">

            <li class="nav-item"> <a class="nav-link" href="viewbudget.php">Manage Budget</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-3" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Category</span>
          <i class="menu-arrow"></i>
          <i class=" mdi mdi-checkerboard  menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic-3">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="addcategory.php">Add Category</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-4" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Report</span>
          <i class="menu-arrow"></i>
          <i class=" mdi mdi-file-document menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic-4">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="viewreport.php">View Report</a></li>

          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-5" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Settings</span>
          <i class="menu-arrow"></i>
          <i class=" mdi mdi-account-settings  menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic-5">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="accountsetting.php">My Profile</a></li>
            <li class="nav-item"> <a class="nav-link" href="changepass.php">Change Password</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">
          <span class="menu-title">Logout</span>
          <i class="mdi mdi-logout menu-icon"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
</body>
</html>