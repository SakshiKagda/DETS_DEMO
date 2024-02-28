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


$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
// Check if there are any users
if ($result->num_rows > 0) {
  $users = array();
  while ($row = $result->fetch_assoc()) {
    $users[] = $row;
  }
} else {
  $users = array();
}
if (!isset($_SESSION['id'])) {

}


$admin_id = $_SESSION['id'];
$selectQuery = "SELECT * FROM admins WHERE id = ?";
$stmt = $conn->prepare($selectQuery);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();


$selectSubQuery = "SELECT s.*, u.username FROM subscription s JOIN users u ON s.user_id = u.user_id";
$stmtSub = $conn->prepare($selectSubQuery);
$stmtSub->execute();
$resultSub = $stmtSub->get_result();
$subscriptions = $resultSub->fetch_all(MYSQLI_ASSOC);

foreach ($subscriptions as $subscription) {
  $expiryDate = strtotime($subscription['end_date']);
  $threeDaysBeforeExpiry = strtotime('-3 days', $expiryDate);
  $currentDate = time();

  if ($currentDate >= $threeDaysBeforeExpiry && $currentDate < $expiryDate) {

    $to = $subscription['email'];
    $subject = "Renew Your Subscription";
    $message = "Dear " . $subscription['username'] . ",\n\nYour subscription is expiring soon. Please renew your subscription to continue using our service.\n\nThank you.";
    $headers = "From: kagdasakshi09@gmail.com";

    mail($to, $subject, $message, $headers);
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
 
</head>
<body>

  <?php


  include("header.php");

  ?>


  <div class="container-fluid page-body-wrapper">

    <?php
    include('sidebar.php');
    ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
              <i class="mdi mdi-home"></i>
            </span> Dashboard
          </h3>
        </div>
        <div class="row">
          <?php
          $sql = "SELECT COUNT(*) AS total_users FROM users";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              echo "<div class='col-md-4 stretch-card grid-margin'>";
              echo "<div class='card bg-gradient-danger card-img-holder text-white'>";
              echo "<div class='card-body'>";
              echo "<img src='assets/images/dashboard/circle.svg' class='card-img-absolute' alt='circle-image'>";
              echo "<h4 class='font-weight-normal mb-3'>Total Users <i class='mdi mdi-account-circle mdi-24px float-right'></i></h4>";
              echo "<h2 class='mb-5'>" . $row["total_users"] . "</h2>";
              echo "<h6 class='card-text'>Increased by 20%</h6>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
            }
          } else {
            echo "0 results";
          }
          ?>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                <h4 class="font-weight-normal mb-3">Total Subscribe users <i
                    class="mdi mdi-account-check mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">5</h2>
                <h6 class="card-text">Decreased by 10%</h6>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                <h4 class="font-weight-normal mb-3">Free Users <i
                    class="mdi mdi-account-minus mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">15</h2>
                <h6 class="card-text">Decreased by 15%</h6>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">User Status</h4>
                <div class="table">
                  <table class="table">
                    <tr>
                      <th>Subscription ID</th>
                      <th> Username </th>
                      <th> End Date </th>
                      <th> Renew </th>
                      
                    </tr>
                    </thead>
                    <?php foreach ($subscriptions as $subscription): ?>
                      <tr>
                        <td>
                          <?php echo $subscription['subscription_id']; ?>
                        </td>
                        <td>
                          <?php echo $subscription['username']; ?>
                        </td>
                        <td>
                          <?php echo $subscription['end_date']; ?>
                        </td>
                        <td>
                          <form action="reminder.php" method="get">
                            <input type="hidden" name="subscription_id"
                              value="<?php echo $subscription['subscription_id']; ?>">
                            <button type="submit" class="btn btn-primary">Renew</button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
           <div class="row">
          <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="clearfix">
                  <h4 class="card-title float-left">Visit And Sales Statistics</h4>
                  <div id="visit-sale-chart-legend"
                    class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                </div>
                <canvas id="visit-sale-chart" class="mt-4"></canvas>
              </div>
            </div>
          </div>
        </div>
          <!-- <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-white">Todo</h4>
                <div class="add-items d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
                  <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn"
                    id="add-task">Add</button>
                </div>
                <div class="list-wrapper">
                  <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                    <li>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox"> Meeting with Alisa </label>
                      </div>
                      <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li class="completed">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox" checked> Call John </label>
                      </div>
                      <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox"> Create invoice </label>
                      </div>
                      <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox"> Print Statements </label>
                      </div>
                      <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li class="completed">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox" checked> Prepare for presentation </label>
                      </div>
                      <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox"> Pick up kids from school </label>
                      </div>
                      <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
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