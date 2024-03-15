<?php
session_start(); // Start the session

include 'connect.php';


if (!isset($_SESSION['id'])) {
  
}

// Retrieve the admin's current details from the database
$admin_id = $_SESSION['id'];
$selectQuery = "SELECT * FROM admins WHERE id = ?";
$stmt = $conn->prepare($selectQuery);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

// Retrieve subscription details from the database
$selectSubQuery = "SELECT * FROM subscription";
$stmtSub = $conn->prepare($selectSubQuery);
$stmtSub->execute();
$resultSub = $stmtSub->get_result();
$subscriptions = $resultSub->fetch_all(MYSQLI_ASSOC);

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
      color: black;
    }

    th {
      color: white;
    }

    tr {
      color: black;
    }

    .thead {
      background-color:#047edf;
    }
    .active {
      background-color: green;

    }

    .inactive {
      background-color: red;
    }

    .pending {
      background-color: yellow;
    }


    .pagination .page-item .page-link {
      color: black;
    }
    .content-wrapper{
      background-color: #E1EEF2 !important;
    }
    .btn-primary{
      background-color:#047edf !important;
      border-color: #047edf !important;
    }
    .page-title .page-title-icon {
    background-color: #2847de !important;
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
    <div class="content-wrapper">
    <div class="page-header">
  <h3 class="page-title">
    <a href="index.php" style="text-decoration: none; color: inherit;"> <!-- Add this anchor tag -->
      <span class="page-title-icon  text-white me-2">
        <i class="mdi mdi-home"></i>
      </span>
    </a> 
    Subscription Details
  </h3>
</div>
<div class="row">
        <div class="table-wrapper" style="height: 1000px; width: 900px; overflow-y:auto" ;>
        <table class=" table table-bordered table-hover">
           
              <thead class="thead">
                <tr>
                  <th>Subscription ID</th>
                  <th>User ID</th>
                  <th>Subscription Plan</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Billing Frequency</th>
                  <th>Amount</th>
                  <th>Payment Method</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($subscriptions as $subscription): ?>
                  <tr>
                    <td>
                      <?php echo $subscription['subscription_id']; ?>
                    </td>
                    <td>
                      <?php echo $subscription['user_id']; ?>
                    </td>
                    <td>
                      <?php echo $subscription['subscription_plan']; ?>
                    </td>
                    <td>
                      <?php echo $subscription['start_date']; ?>
                    </td>
                    <td>
                      <?php echo $subscription['end_date']; ?>
                    </td>
                    <td>
                      <?php echo $subscription['billing_frequency']; ?>
                    </td>
                    <td>
                      <?php echo $subscription['amount']; ?>
                    </td>
                    <td>
                      <?php echo $subscription['payment_method']; ?>
                    </td>
                    <td>
                      <?php echo $subscription['status']; ?>
                    </td>

                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
            <a href="index.php" class="btn btn-primary mt-3">Go Back</a>
          </div>
        </div>
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
</body>

</html>