<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'expense_db';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user ID from the session
$user_id = $_SESSION['id'];

// Retrieve user details
$sql_user = "SELECT * FROM users WHERE id = $user_id";
$result_user = $conn->query($sql_user);

// Check if user details are found
if ($result_user->num_rows > 0) {
    $row_user = $result_user->fetch_assoc();
    $username = $row_user['username'];
    $email = $row_user['email'];
    $mobile_number = $row_user['mobile_number'];
} else {
    // Redirect or show error message if user details are not found
    header("Location: error.php");
    exit();
}

// Retrieve budget data for the user including the username
$sql_budget = "SELECT budget.*, users.username AS user_username FROM budget JOIN users ON budget.user_id = users.id WHERE budget.user_id = $user_id";
$result_budget = $conn->query($sql_budget);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Expense Tracker System - View Budget</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .main{
            display: flex;
            padding-top: 70px;
        }
        h2{
            color: blueviolet;
        }
        tr{
            color: blue;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
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
        <h2>View Budget</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-sucess">
                <tr>
                    <th>Mobile Number</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Category</th>
                    <th>Planned Amount</th>
                    <th>Actual Amount</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if budget data is found
                if ($result_budget->num_rows > 0) {
                    while ($row_budget = $result_budget->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $mobile_number . "</td>";
                        echo "<td>" . $row_budget['user_username'] . "</td>";
                        echo "<td>" . $email . "</td>";
                        echo "<td>" . $row_budget['category'] . "</td>";
                        echo "<td>$" . $row_budget['planned_amount'] . "</td>";
                        echo "<td>$" . $row_budget['actual_amount'] . "</td>";
                        echo "<td>" . $row_budget['start_date'] . "</td>";
                        echo "<td>" . $row_budget['end_date'] . "</td>";
                        echo "<td>";
                        // Check if actual amount exceeds planned amount
                        if ($row_budget['actual_amount'] > $row_budget['planned_amount']) {
                            echo "<span style='color: red;'>Exceeded</span>";
                        } else {
                            echo "OK";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Display message if no budget data is found
                    echo "<tr><td colspan='9'>No budget data found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary mt-3">Go Back</a>
    </div> 

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</div>

<footer>
    <?php include("footer.php"); ?>
</footer>

</body>
</html>
