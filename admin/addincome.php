<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code here
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

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO income (incomeName, incomeAmount, incomeCategory, incomeDescription, incomeDate) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $incomeName, $incomeAmount, $incomeCategory, $incomeDescription, $incomeDate);

    // Set parameters
    $incomeName = $_POST['incomeName'];
    $incomeAmount = $_POST['incomeAmount'];
    $incomeCategory = $_POST['incomeCategory'];
    $incomeDescription = $_POST['incomeDescription'];
    $incomeDate = $_POST['incomeDate'];

    // Execute query
    if ($stmt->execute()) {
        echo "Income added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Form not submitted.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Income</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Add Income</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="incomeName">Income Name:</label>
                <input type="text" id="incomeName" name="incomeName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="incomeAmount">Income Amount:</label>
                <input type="number" id="incomeAmount" name="incomeAmount" class="form-control" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="incomeCategory">Income Category:</label>
                <input type="text" id="incomeCategory" name="incomeCategory" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="incomeDescription">Income Description:</label>
                <input type="text" id="incomeDescription" name="incomeDescription" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="incomeDate">Income Date:</label>
                <input type="date" id="incomeDate" name="incomeDate" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Income</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
