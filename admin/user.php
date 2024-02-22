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

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Expense Tracker System</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    .main {
      display: flex;
      padding-top: 70px;
    }
    h2{
            color: blueviolet;
        }
        th{
          color: blue;
        }
    .container {
      max-width: 900px;
    }
    .active{
      background-color:  #b8a9c9;

    }
    .inactive{
      background-color:  #e06377;
    }
    .pending{
      background-color:#eeac99 ;
    }
  </style>
</head>

<body>
  <header>
    <?php include("header.php"); ?>
  </header>

  <div class="main">
    <sidebar>
      <?php include("sidebar.php"); ?>
    </sidebar>
    <div class="container">
      <h2>Users Details</h2>
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
                  if ($user['pricing_status'] == 0) {
                    echo "Inactive";
                  } else if ($user['pricing_status'] == 1) {
                    echo "Active";
                  } else if ($user['pricing_status'] == 2) {
                    echo "Pending";
                  }
                  ?>
                </td>
                <td>
                <form method="post" action="update_pricing_status.php">
                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                    <input type="hidden" name="pricing_status" id="pricing_status">
                    <button type="submit" name="pricing_status" value="active" class="btn-sm active ">Active</button>
                    <button type="submit" name="pricing_status" value="inactive" class="btn-sm inactive">Inactive</button>
                    <button type="submit" name="pricing_status" value="pending" class="btn-sm  pending">Pending</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS and Popper.js -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <footer>
    <?php include("footer.php"); ?>
  </footer>
  <script>
    // Get the button elements
    var activeButtons = document.querySelectorAll('.active');
    var inactiveButtons = document.querySelectorAll('.inactive');
    var pendingButtons = document.querySelectorAll('.pending');

    // Add event listeners to the buttons
    activeButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        alert('User status updated to Active and Email Sent Sucessfully');
      });
    });

    inactiveButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        alert('User status updated to Inactive');
      });
    });

    pendingButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        alert('User status updated to Pending');
      });
    });
  </script>
</body>

</html>