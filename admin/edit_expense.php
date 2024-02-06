<?php
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

// Check if expense ID is provided
if (!isset($_GET['id'])) {
    echo "Expense ID not provided";
    exit();
}

$expense_id = $_GET['id'];

// Retrieve expense data from the database
$sql = "SELECT * FROM expenses WHERE id = $expense_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $expense = $result->fetch_assoc();
} else {
    echo "Expense not found";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and process form data
    // Update expense record in the database
    $expenseName = $_POST['expenseName'];
    $expenseAmount = $_POST['expenseAmount'];
    $expenseCategory = $_POST['expenseCategory'];
    $expenseDescription = $_POST['expenseDescription'];
    $expenseDate = $_POST['expenseDate'];

    $sql = "UPDATE expenses SET expenseName='$expenseName', expenseAmount='$expenseAmount', expenseCategory='$expenseCategory', expenseDescription='$expenseDescription', expenseDate='$expenseDate' WHERE id=$expense_id";

    if ($conn->query($sql) === TRUE) {
        echo "Expense updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense</title>
</head>
<body>
    <h2>Edit Expense</h2>
    <form method="POST" action="">
        <div>
            <label for="expenseName">Expense Name:</label>
            <input type="text" id="expenseName" name="expenseName" value="<?php echo $expense['expenseName']; ?>" required>
        </div>
        <div>
            <label for="expenseAmount">Expense Amount:</label>
            <input type="number" id="expenseAmount" name="expenseAmount" value="<?php echo $expense['expenseAmount']; ?>" step="0.01" required>
        </div>
        <div>
            <label for="expenseCategory">Expense Category:</label>
            <input type="text" id="expenseCategory" name="expenseCategory" value="<?php echo $expense['expenseCategory']; ?>" required>
        </div>
        <div>
            <label for="expenseDescription">Expense Description:</label>
            <input type="text" id="expenseDescription" name="expenseDescription" value="<?php echo $expense['expenseDescription']; ?>" required>
        </div>
        <div>
            <label for="expenseDate">Expense Date:</label>
            <input type="date" id="expenseDate" name="expenseDate" value="<?php echo $expense['expenseDate']; ?>" required>
        </div>
        <button type="submit">Update Expense</button>
    </form>
</body>
</html>
