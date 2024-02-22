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

    h2 {
      color: blueviolet;
    }

    th {
      color: blue;
    }

    .container {
      max-width: 900px;
    }
    .badge{
      border: none;
      /* width: 76px; */
      /* height: 36px; */
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
                    <button id="active" type="submit" name="pricing_status" value="active" class="badge  bg-success ">Active</button>
                    <button id="inactive" type="submit" name="pricing_status" value="inactive" class="badge  bg-danger">Inactive</button>
                    <button id="pending" type="submit" name="pricing_status" value="pending" class="badge  bg-primary">Pending</button>
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
    var activeBadge = document.getElementById('active');
    var inactiveButtons = document.getElementById('inactive');
    var pendingButtons = document.getElementById('pending');

    // Add event listeners to the buttons
    document.getElementById('active').addEventListener('click', function() {
        alert('User status updated to Active and Email Sent Sucessfully');
      });
  

   document.getElementById('inactive').addEventListener('click', function() {
        alert('User status updated to Inactive');
      });

      document.getElementById('pending').addEventListener('click', function() {
        alert('User status updated to Pending');
      });
  </script>
</body>

</html>