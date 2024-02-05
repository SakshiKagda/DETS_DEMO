<?php

if(!isset($_SESSION)) 
{ 
  session_start(); 
} 


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expense_db";

$conn = new mysqli($servername, $username, $password, $dbname);
// $userDetails = array();

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (isset($_SESSION['id'])) {
  $_SESSION['id'] = $user_id;



  $sql = "SELECT * FROM users WHERE id = '$user_id'";
  $result = $conn->query($sql);

  if ($result !== false) {
    if ($result->num_rows > 0) {
      // ... rest of your code
    } else {
      echo "User details not found.";
    }
  } else {
    echo "SQL Query Error: " . $conn->error;
  }

  if ($result !== false && $result->num_rows > 0) {
    $userDetails = $result->fetch_assoc();

    // Check if 'email' key exists
    if (isset($userDetails['email'])) {
      $userEmail = $userDetails['email'];
    } else {
      // Handle the case where 'email' key is not present
      echo "Email not found in user details.";
    }
  } else {
    // Handle the case where user details are not found
    echo "User details not found.";
  }
  // } else {
//     echo "User ID not set.";
}
?>


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
            <!-- Use the user's profile image if available, otherwise use a default image -->
            <?php if (!empty($userDetails['profile_image'])): ?>
              <img src="<?php echo $userDetails['profile_image']; ?>" alt="profile">
            <?php else: ?>
              <img src="assets/images/default_profile.jpg" alt="profile">
            <?php endif; ?>
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
            
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">
              <?php echo $userDetails['username']; ?>
            </span>
            <span class="text-secondary text-small">
              <?php echo $userDetails['email']; ?>
            </span>
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
<<<<<<< HEAD
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
        <a class="nav-link" href="logout.php">
          <span class="menu-title">Logout</span>
          <i class="mdi mdi-logout menu-icon"></i>
        </a>
      </li>
    </ul>
  </nav>

</body>

</html>
=======
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">Sakshi</span>
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
  </ul>
</nav>
>>>>>>> master
