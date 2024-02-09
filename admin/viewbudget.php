<?php
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'expense_db';

$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['id'];

$sql = "SELECT users.mobile_number, users.username, users.email, budget.category, budget.planned_amount, budget.actual_amount
        FROM users
        INNER JOIN budget ON users.id = budget.user_id
        WHERE budget.user_id = $user_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Budget</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container mt-5">
        <h2>View Budget</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Mobile Number</th>
                <th>Username</th>
                <th>Email</th>
                <th>Category</th>
                <th>Planned Amount</th>
                <th>Actual Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["mobile_number"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>" . $row["planned_amount"] . "</td>";
                echo "<td style='color: " . ($row["actual_amount"] > $row["planned_amount"] ? "red" : "black") . "'>" . $row["actual_amount"] . "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary">Go Back</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
} else {
    echo "No budget data found.";
}
?>
