<?php
// Start session
session_start();

// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'expense_db';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Budget</title>
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

        tr {
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

        <!-- Table to display budget -->
        <table class="table table-bordered table-striped">
            <thead class="thead-sucess">
            <tr>
                <th>Budget Name</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Retrieve user ID from the session
            $user_id = $_SESSION['id'];

            // Retrieve budget data for the logged-in user
            $sql = "SELECT * FROM budget WHERE user_id = $user_id"; // Modify the query based on your database schema
            $result = $conn->query($sql);

            // Check if any budget records exist
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["category"] . "</td>";
                    echo "<td>$" . $row["amount"] . "</td>";
                    echo "<td>" . $row["startdate"] . "</td>";
                    echo "<td>" . $row["enddate"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_budget.php?id=" . $row["budget_id"] . "' class='btn btn-warning btn-sm'>Edit</a>";
                    echo "<a href='delete_budget.php?id=" . $row["budget_id"] . "' class='btn btn-danger btn-sm ml-1'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No budget records found.</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary mt-3">Go Back</a>
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
