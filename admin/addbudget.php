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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_SESSION['id']; // Assuming user is logged in
    $category = $_POST['category'];
    $planned_amount = $_POST['planned_amount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Prepare and execute SQL query to insert budget data
    $sql = "INSERT INTO budget (user_id, category, planned_amount, actual_amount, start_date, end_date)
            VALUES (?, ?, ?, 0, ?, ?)"; // Set actual_amount initially to 0
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $user_id, $category, $planned_amount, $start_date, $end_date);
    
    if ($stmt->execute()) {
        // Budget added successfully, redirect to view_budget.php or any other page
        header("Location: viewbudget.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Budget</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Add Budget</h2>
        <form method="POST" action="viewbudget.php">
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="planned_amount">Planned Amount:</label>
                <input type="number" id="planned_amount" name="planned_amount" class="form-control" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Budget</button>
            <a href="viewbudget.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>

