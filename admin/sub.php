
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
    /* .container {
      max-width: 800px;
      margin: 50px auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      position: relative;
    } */
    .active{
      background-color: green;

    }
    .inactive{
      background-color: red;
    }
    .pending{
      background-color: yellow;
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
    <div class="container mt-5">
      <h2>Subscription Details</h2>
      <div class="table-responsive">
        <table class="table table-stripped table-border">
          <thead>
            <tr>
              <th>Subscription ID</th>
              <th>User ID</th>
              <th>Subscription Plan</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>1</td>
              <td>Premium Plan</td>
              <td>2024-02-19</td>
              <td>2025-02-19</td>
              <td>Active</td>
            </tr>
            <tr>
              <td>2</td>
              <td>2</td>
              <td>Premium Plan</td>
              <td>2024-01-01</td>
              <td>2025-01-01</td>
              <td>Inactive</td>
            </tr>
            <tr>
              <td>3</td>
              <td>3</td>
              <td>Premium Plan</td>
              <td>2022-01-01</td>
              <td>2022-12-31</td>
              <td>Pending</td>
            </tr>
          </tbody>
        </table>
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
