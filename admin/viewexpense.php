<?php
// Start session
session_start();


// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expense_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch expenses
$sql = "SELECT * FROM expenses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Expense Tracker System - View Expenses</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
         .main{
            display: flex;
            padding-top: 70px ;
         
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
            <h2>View Expenses</h2>
            <!-- Table to display expenses -->
            <table class="table table-bordered table-striped"> 
                <thead class="thead-sucess">
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if any expenses exist
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["expenseDate"] . "</td>";
                            echo "<td>" . $row["expenseCategory"] . "</td>";
                            echo "<td>" . $row["expenseDescription"] . "</td>";
                            echo "<td>$" . $row["expenseAmount"] . "</td>";
                            echo "<td>";
                            echo "<a href='edit_expense.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a>";
                            echo "<a href='delete_expense.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm ml-1'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No expenses found.</td></tr>";
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
