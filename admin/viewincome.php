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
$sql = "SELECT * FROM income";
$result = $conn->query($sql);
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
            <h2>View Income</h2>
            
            <!-- Table to display expenses -->
            <table class="table table-bordered table-striped"> 
                <thead class="thead-sucess">
                <th>Income Name</th>
                    <th>Income Amount</th>
                    <th>Income Category</th>
                    <th>Income Description</th>
                    <th>Income Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
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
                    $sql = "SELECT * FROM income";
                    $result = $conn->query($sql);

                    // Check if any expenses exist
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["incomeName"] . "</td>";
                            echo "<td>" . $row["incomeAmount"] . "</td>";
                            echo "<td>" . $row["incomeCategory"] . "</td>";
                            echo "<td>" . $row["incomeDescription"] . "</td>";
                            echo "<td>" . $row["incomeDate"] . "</td>";
                            echo "<td>";
                            echo "<a href='edit_income.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit</a> ";
                            echo "<a href='delete_income.php?id=" . $row["id"] . "' class='btn btn-danger'>Delete</a>";
                            echo "</td>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No income records found</td></tr>";
                    }

                    // Close connection
                    $conn->close();
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
