<?php
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

// Get the user ID and pricing status from the form
$user_id = $_POST['user_id'];
if (isset($_POST['pricing_status'])) {
  $pricing_status = $_POST['pricing_status'];

  // Update the pricing status in the users table
  if ($pricing_status == 'active') {
    $pricing_status_value = 1;
  } else {
    $pricing_status_value = 0;
  }

  $sql = "UPDATE users SET pricing_status = '$pricing_status_value' WHERE user_id = $user_id";

  if ($conn->query($sql) === TRUE) {
    echo "Pricing status updated successfully";
  } else {
    echo "Error updating pricing status: " . $conn->error;
  }
} else {
  echo "Pricing status not set";
}

$conn->close();
?>
