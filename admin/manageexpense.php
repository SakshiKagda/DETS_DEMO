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
$sql = "SELECT users.*, SUM(expenses.expenseAmount) AS totalExpense, SUM(incomes.incomeAmount) AS totalIncome FROM users LEFT JOIN expenses ON users.user_id = expenses.user_id LEFT JOIN incomes ON users.user_id = incomes.user_id GROUP BY users.user_id";
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

        .badge {
            border: none;
            width: 70px;
            height: 39px;

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
                            <th>Total Expense</th>
                            <th>Total Income</th>
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
                                <td <?php if ($user['totalExpense'] > $user['totalIncome']) echo 'style="color: red;"'; ?>>
            <?php echo $user['totalExpense']; ?>
        </td>
        <td>
            <?php echo $user['totalIncome']; ?>
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
        document.getElementById('active').addEventListener('click', function () {
            alert('User status updated to Active and Email Sent Sucessfully');
        });


        document.getElementById('inactive').addEventListener('click', function () {
            alert('User status updated to Inactive');
        });

        document.getElementById('pending').addEventListener('click', function () {
            alert('User status updated to Pending');
        });
    </script>
</body>

</html>