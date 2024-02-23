<?php
session_start();
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
        /* .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        } */
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
            
            <?php
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
            
            // SQL query to fetch users who have added expenses
            $sql = "SELECT DISTINCT users.user_id AS user_id, users.username AS username, users.email AS email FROM users INNER JOIN expenses ON users.user_id = expenses.user_id";

            // echo $sql;
            $result = $conn->query($sql);
            
            // Check if any users exist
            if ($result->num_rows > 0) {
                // Output data of each user
                while ($row = $result->fetch_assoc()) {
                    $userId = $row["user_id"];
                    $username = $row["username"];
                    $email = $row["email"];
                    
                    // SQL query to fetch expenses for the current user
                    $expenseSql = "SELECT * FROM expenses WHERE user_id = $userId";
                    $expenseResult = $conn->query($expenseSql);
                    
                    // Check if any expenses exist for the current user
                    if ($expenseResult->num_rows > 0) {
                        echo "<h3>User: $username ($email)</h3>";
                        // Output table for expenses
                        echo "<table class='table table-bordered table-hover'>"; 
                        echo "<thead class='thead-sucess'>";
                        echo "<tr>";
                        echo "<th>User ID</th>";
                        echo "<th>Expense Name</th>";
                        echo "<th>Amount</th>";
                        echo "<th>Category</th>";
                        echo "<th>Description</th>";
                        echo "<th>Date</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        
                        // Output data of each expense
                        $totalExpense = 0; // Initialize total expense for the user
                        while ($expenseRow = $expenseResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $expenseRow["user_id"] . "</td>";
                            echo "<td>" . $expenseRow["expenseName"] . "</td>";
                            echo "<td>" . $expenseRow["expenseAmount"] . "</td>";
                            echo "<td>" . $expenseRow["expenseCategory"] . "</td>";
                            echo "<td>" . $expenseRow["expenseDescription"] . "</td>";
                            echo "<td>" . $expenseRow["expenseDate"] . "</td>";
                            echo "</tr>";
                            
                            // Add the expense amount to the total expense
                            $totalExpense += $expenseRow["expenseAmount"];
                        }
                        
                        // Display the total expense for the user
                        echo "<tr>";
                        echo "<td colspan='2'>Total Expense</td>";
                        echo "<td>$totalExpense</td>";
                        echo "<td colspan='3'></td>"; // colspan='3' to span the remaining columns
                        echo "</tr>";
                        
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<p>No expenses found for user: $username ($email)</p>";
                    }
                    echo "<br><br><br>";
                }
            } else {
                echo "<p>No users found.</p>";
            }
        // Pagination variables
$results_per_page = 10; // Set the desired number of results per page
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
$offset = ($page - 1) * $results_per_page;
if (!$result) {
    die("Error: " . $conn->error);
}

           
            ?>
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

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <footer>
        <?php include("footer.php"); ?>
    </footer>
</body>
</html>
