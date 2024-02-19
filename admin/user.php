<?php
// session_start();
if (!isset($_SESSION)) {
  session_start();
}
// Establish a connection to your database
$servername = "localhost";
$username = "root";
$password = "";
$database = "expense_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch user details from the user table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if there are any users
if ($result->num_rows > 0) {
  // Fetch user details and populate the $users array
  $users = array();
  while ($row = $result->fetch_assoc()) {
    $users[] = $row;
  }
} else {
  $users = array(); // If no users found, initialize an empty array
}
?>
<!DOCTYPE html>
<html lang="en">

<body>
  <!-- partial:partials/_navbar.html -->
  <?php


  include("header.php");

  ?>

  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php
    include('sidebar.php');
    ?>
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Users</h4>
            <div class="table-responsive">
              <table class="table table-stripped table-border">
                <thead>
                  <tr>
                    <th>Profile Image</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Mobile Number</th>
                    <th>Current Status</th>
                    <th>Action</th>
                    <!-- <th>Registration Date</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $user): ?>
                    <tr>
                      <td><img src="<?php echo $user['profile_image']; ?>" alt="Profile Image"
                          style="width: 50px; height: 50px;"></td>
                      <td>
                        <?php echo $user['username']; ?>
                      </td>
                      <td>
                        <?php echo $user['email']; ?>
                      </td>
                      <td>
                        <?php echo $user['gender']; ?>
                      </td>
                      <td>
                        <?php echo $user['mobile_number']; ?>
                      </td>
                      <td>
                      <?php 
                        if($user['pricing_status'] == 0) {
                          echo "Inactive";
                        } else if($user['pricing_status'] == 1) {
                          echo "Active";
                        } else if($user['pricing_status'] == 2) {
                          echo "Pending";
                        }
                        ?>
                      </td>
                      <td>
                        <form method="post" action="update_pricing_status.php">
                          <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                          <input type="hidden" name="pricing_status" id="pricing_status">
                          <button type="submit" name="pricing_status" value="active"
                           >Active</button>
                          <button type="submit" name="pricing_status" value="inactive"
                           >Deactive</button>
                            <button type="submit" name="pricing_status" value="pending"
                           >Pending</button>
                          
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    include('footer.php');
    ?>
    <!-- partial -->
  </div>
  <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
</body>

</html>
